<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $logo_1
 * @property string $logo_2
 * @property string $background
 * @property string $director_signature
 * @property string $certificate_type
 * @property string $created_at
 * @property string $updated_at
 * @property Programmes[] $programmes
 */
class CertificateConfigs extends Model
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
    protected $fillable = ['name', 'logo_1', 'logo_2', 'background', 'director_signature', 'certificate_type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmes()
    {
        return $this->hasMany('App\Programme', 'certificate_conf');
    }
}
