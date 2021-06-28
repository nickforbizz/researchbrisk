<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * @property int $id
 * @property int $user_id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property int $active
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Job[] $jobs
 */
class JobCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'uuid', 'name', 'description', 'active', 'archived', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    // funcs
    public function storeData($input){
        return static::create($input + ['user_id' => \Auth::user()->id]);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
