<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property integer $certificate_conf
 * @property integer $created_by
 * @property string $programme_name
 * @property string $organiser
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
    use SoftDeletes;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cert_committees','organiser','slug','cert_participants', 'created_by', 'programme_name', 'programme_location', 'programme_start', 'programme_end', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'programme_start' => 'date:d / m / Y',
        'programme_end' => 'date:d / m / Y',
    ];

    public function certCommittees()
    {
        return $this->belongsTo('App\CertificateConfig', 'cert_committees');
    }

    public function certParticipants()
    {
        return $this->belongsTo('App\CertificateConfig', 'cert_participants');
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
    public function galleries()
    {
        return $this->hasMany('App\Gallery');
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
    public function committees() {
        return $this->candidates()->where('type','=', 2);
    }

    public function participants() {
        return $this->candidates()->where('type','=', 1);
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
    public function getLabelAttribute()
    {
        switch($this->status) {
            case 1:
                $label = '<span><i class="fas fa-circle text-primary mr-1"></i>'.__('label.draft').'</span>';
                break;
            case 2:
                $label = '<span><i class="fas fa-circle text-info mr-1"></i>'.__('label.wait_approval').'</span>';
                break;
            case 3:
                $label = '<span><i class="fas fa-circle text-success mr-1"></i>'.__('label.approved').'</span>';
                break;
            default:
                $label = '<span><i class="fas fa-circle text-danger mr-1"></i>'.__('label.unknown').'</span>';
        }

        return $label;
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

    /**
     * Combine start date with end date if both have same date.
     * @return string
     * @var string
     */
    public function getProgrammeDateForCertAttribute()
    {
        setlocale(LC_TIME, '	ms_MY.utf8', 'Malay_malaysia.1252', 'Malaysian');

        $start_date = Carbon::parse($this->programme_start)->formatLocalized('%e %B %G');
        $end_date = Carbon::parse($this->programme_end)->formatLocalized('%e %B %G');


        if ($start_date !== $end_date) {
            return Str::upper($start_date . ' SEHINGGA ' . $end_date);
        } else {
            return Str::upper($start_date);
        }
    }

    public function setProgrammeNameAttribute($value)
    {
        $this->attributes['programme_name'] = strtoupper($value);
    }

    public function getProgrammeNameAttribute()
    {
         return strtoupper($this->attributes['programme_name']);
    }

    public function setProgrammeLocationAttribute($value)
    {
        $this->attributes['programme_location'] = strtoupper($value);
    }

    public function getProgrammeLocationAttribute()
    {
        return strtoupper($this->attributes['programme_location']);
    }

    public function setOrganiserAttribute($value)
    {
        $this->attributes['organiser'] = strtoupper($value);
    }

    public function getOrganiserAttribute()
    {
        return strtoupper($this->attributes['organiser']);
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

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        return $query;
    }

    public function totalCertificate()
    {
        return $this->candidates()->count();
    }
}

