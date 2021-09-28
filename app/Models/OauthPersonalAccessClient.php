<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $client_id
 * @property string $created_at
 * @property string $updated_at
 */
class OauthPersonalAccessClient extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['client_id', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

}
