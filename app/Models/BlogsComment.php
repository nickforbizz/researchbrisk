<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * @property int $id
 * @property int $blog_id
 * @property int $user_id
 * @property string $email
 * @property string $name
 * @property string $comment
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Blog $blog
 */
class BlogsComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['uuid', 'blog_id', 'parent_id', 'user_id', 'email', 'name', 'comment', 'archived', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }


    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(BlogsComment::class, 'parent_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
