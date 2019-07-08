<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

    /**
 * @property integer $id
 * @property integer $certificate_conf
 * @property integer $created_by
 * @property string $programme_name
 * @property string $programme_location
 * @property string $programme_start
 * @property string $programme_end
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property CertificateConfig $certificateConfig
 * @property User $user
 * @property Candidate[] $candidates
 * @property Document[] $documents
 */
class Programme extends Model
{
    protected $appends = ['programme_date'];

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['certificate_conf', 'created_by', 'programme_name', 'programme_location', 'programme_start', 'programme_end', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'programme_start' => 'date:d / m / Y',
        'programme_end' => 'date:d / m / Y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function certificateConfig()
    {
        return $this->belongsTo('App\CertificateConfig', 'certificate_conf');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidates()
    {
        return $this->hasMany('App\Candidate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    /**
     * Set the programme's status based on value.
     * @return string
     * @var integer
     */
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return $this->attributes['status'] = '<span><i class="fas fa-circle text-success mr-1"></i>'.__('label.draft').'</span>';
        } else {
            return $this->attributes['status'] = '<span><i class="fas fa-circle text-success mr-1"></i>'.__('label.draft').'</span>';
        }
    }

    /**
     * Combine start date with end date if both have same date.
     * @return string
     * @var string
     */
    public function getProgrammeDateAttribute()
    {
        $start_date = Carbon::parse($this->programme_start)->format('d / m / Y');
        $end_date = Carbon::parse($this->programme_end)->format('d / m / Y');

        if ($start_date !== $end_date) {
            return $start_date . '<i class="fas fa-arrow-right text-primary ml-4 mr-4"></i>' . $end_date;
        } else {
            return $start_date;
        }
    }

    public function setProgrammeNameAttribute($value)
    {
        $this->attributes['programme_name'] = strtoupper($value);
    }

    public function setProgrammeStartAttribute($value)
    {
        $this->attributes['programme_start'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function setProgrammeEndAttribute($value)
    {
        $this->attributes['programme_end'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('programme_name')) {
            $query->where('programme_name', 'like', '%' . $request->input('programme_name') . '%');
        }

        if ($request->has('programme_date')) {
            $query->whereBetween('programme_start', [
                Carbon::create($request->input('programme_date'))->startOfYear(),
                Carbon::create($request->input('programme_date'))->endOfYear(),
            ]);
        }

        return $query;
    }
}
