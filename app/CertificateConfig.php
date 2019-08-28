<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property string $original
 * @property string $converted
 * @property string $alignment_director
 * @property int $convert_status
 * @property int $certificate_type
 * @property string $created_at
 * @property string $updated_at
 * @property CertificateContent[] $certificateContents
 * @property Programme[] $programmes
 */
class CertificateConfig extends Model
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
    protected $fillable = ['name','orientation','alignment_director','qr_x','qr_y','qr_width','qr_height','show_director', 'original', 'converted', 'convert_status', 'certificate_type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificateContents()
    {
        return $this->hasMany('App\CertificateContent', 'config_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmes()
    {
        return $this->hasMany('App\Programme', 'certificate_conf');
    }

    /**
     * Set the converting's status based on value.
     * @return string
     * @var integer
     */
    public function getConvertStatusAttribute($value)
    {
        switch ($value) {
            case 1:
                $this->attributes['convert_status'] = '<button class="btn btn-sm btn-primary" ><span>'.__("label.processing").'</span></button>';
                break;
            case 2:
                $this->attributes['convert_status'] = '<button class="btn btn-sm btn-success" ><span>' . __('label.processed') . '</span></button>';
                break;
            default:
                $this->attributes['convert_status'] = '<button class="btn btn-sm btn-danger" ><span>' . __('label.failed') . '</span></button>';
        }
        return $this->attributes['convert_status'];
    }

    /**
     * Set the certificate's type based on value.
     * @return string
     * @var integer
     */
    public function getCertificateTypeAttribute($value)
    {
        switch ($value) {
            case 1:
                $this->attributes['certificate_type'] = '<button class="btn btn-sm btn-primary" ><span>'.__("label.participant").'</span></button>';
                break;
            case 2:
                $this->attributes['certificate_type'] = '<button class="btn btn-sm btn-primary" ><span>'.__("label.appreciation").'</span></button>';
                break;
            default:
                $this->attributes['certificate_type'] = '<button class="btn btn-sm btn-primary" ><span>'.__("label.unknown").'</span></button>';
        }
        return $this->attributes['certificate_type'];
    }
}
