<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * @property int $id
 * @property int $blog_id
 * @property int $tag_id
 * @property int $user_id
 * @property string $uuid
 * @property string $blog_title
 * @property string $tag_title
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property BlogTag $blogTag
 * @property Blog $blog
 * @property User $user
 */
class BlogTagsPivot extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_tags_pivot';

    /**
     * @var array
     */
    protected $fillable = ['blog_id', 'tag_id', 'user_id', 'uuid', 'blog_title', 'tag_title', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blogTag()
    {
        return $this->belongsTo('App\Models\BlogTag', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
