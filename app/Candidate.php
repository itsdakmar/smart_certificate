<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programme_id
 * @property string $identity_card
 * @property string $name
 * @property string $task
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 * @property Programme $programme
 */
class Candidate extends Model
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
    protected $fillable = ['programme_id', 'task', 'identity_card', 'name', 'type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
