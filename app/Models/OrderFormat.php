<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $remember_token
 * @property int $active
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property GuestOrder[] $guestOrders
 * @property Order[] $orders
 */
class OrderFormat extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description', 'remember_token', 'active', 'archived', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guestOrders()
    {
        return $this->hasMany('App\Models\GuestOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
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
