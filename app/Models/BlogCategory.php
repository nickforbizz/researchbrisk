<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $description
 * @property int $active
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Blog[] $blogs
 */
class BlogCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'description', 'active', 'archived', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }

     // funcs
     public function storeData($input){
        static::create($input + ['user_id' => \Auth::user()->id]);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
