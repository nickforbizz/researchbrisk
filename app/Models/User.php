<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property string $remember_token
 * @property int $user_level
 * @property string $name
 * @property string $password
 * @property string $image_file
 * @property int $status
 * @property int $archived
 * @property string $admin
 * @property string $created_at
 * @property string $updated_at
 * @property string $email_verified_at
 * @property Blog[] $blogs
 * @property Order[] $orders
 * @property PaperPrice[] $paperPrices
 */
class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['email', 'remember_token', 'user_level', 'name', 'password', 'image_file', 'status', 'active', 'archived', 'admin', 'created_at', 'updated_at', 'email_verified_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paperPrices()
    {
        return $this->hasMany('App\Models\PaperPrice');
    }
}
