<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $certificate_conf
 * @property string $programme_name
 * @property string $programme_start
 * @property string $programme_end
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property CertificateConfigs $certificateConfig
 * @property Candidates[] $candidates
 * @property Documents[] $documents
 */
class Programmes extends Model
{

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['certificate_conf', 'programme_name', 'programme_start', 'programme_end', 'status', 'created_by', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'programme_start' => 'date:Y-m-d',
        'programme_end' => 'date:Y-m-d',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function certificateConfig()
    {
        return $this->belongsTo('App\CertificateConfig', 'certificate_conf');
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
            return $this->attributes['status'] = 'Permohonan';
        } else {
            return $this->attributes['status'] = 'tahi';
        }
    }

    /**
     * Combine start date with end date if both have same date.
     * @return string
     * @var string
     */
    public function getProgrammeStartAttribute($value)
    {
        $start_date = Carbon::parse($value)->format('d / m / Y');
        $end_date = Carbon::parse($this->programme_end)->format('d / m / Y');

        if($start_date !== $end_date){
            return $this->attributes['programme_start'] = $start_date . '<i class="fas fa-arrow-right text-primary ml-4 mr-4"></i>' . $end_date ;
        }else {
            return $this->attributes['programme_start'] = $start_date;
        }
    }
}
