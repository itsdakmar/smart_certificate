<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $config_id
 * @property string $content
 * @property integer $x
 * @property integer $y
 * @property integer $font_size
 * @property string alignment
 * @property string $created_at
 * @property string $updated_at
 * @property CertificateConfig $certificateConfig
 */
class CertificateContent extends Model
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
    protected $fillable = ['config_id', 'alignment', 'font_size', 'content', 'x', 'y', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function certificateConfig()
    {
        return $this->belongsTo('App\CertificateConfig', 'config_id');
    }

    public function setAlignmentAttribute($value)
    {
        $this->attributes['alignment'] = strtoupper($value);
    }
}
