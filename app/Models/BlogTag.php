<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
/**
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property int $user_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property BlogTagsPivot[] $blogTagsPivots
 */
class BlogTag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['uuid', 'title', 'user_id', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogTagsPivots()
    {
        return $this->hasMany('App\Models\BlogTagsPivot', 'tag_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
