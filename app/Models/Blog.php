<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * @property int $id
 * @property int $user_id
 * @property int $blog_category_id
 * @property string $uuid
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $body
 * @property string $media_link
 * @property string $media_name
 * @property string $media_type
 * @property string $jobs
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property BlogCategory $blogCategory
 * @property User $user
 * @property BlogTagsPivot[] $blogTagsPivots
 * @property BlogsComment[] $blogsComments
 */
class Blog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'blog_category_id', 'uuid', 'slug', 'title', 'description', 'body', 'media_link', 'media_name', 'media_type', 'jobs', 'archived', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blogCategory()
    {
        return $this->belongsTo('App\Models\BlogCategory');
    }

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
    public function blogTagsPivots()
    {
        return $this->hasMany('App\Models\BlogTagsPivot');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogsComments()
    {
        return $this->hasMany('App\Models\BlogsComment')->orderBy('id', 'desc')->whereNull('parent_id');
    }


 
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
