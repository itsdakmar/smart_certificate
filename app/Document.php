<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property integer $programme_id
 * @property string $name
 * @property string $file_url
 * @property string $created_at
 * @property string $updated_at
 * @property Programme $programme
 */
class Document extends Model
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
    protected $fillable = ['programme_id', 'name', 'file_url', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }

    public function setFileUrlAttribute($value)
    {
        $this->attributes['file_url'] = Str::replaceFirst('documents/','',$value);
    }
}
