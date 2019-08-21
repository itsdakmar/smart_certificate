<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


/**
 * @property integer $id
 * @property integer $programme_id
 * @property integer $uploaded_by
 * @property string $name
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 * @property Programme $programme
 */
class Gallery extends Model
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
    protected $fillable = ['programme_id', 'path','uploaded_by', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }

    public function setPathAttribute($value)
    {
        $this->attributes['path'] = Str::replaceFirst('photos/','',$value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'uploaded_by');
    }
}
