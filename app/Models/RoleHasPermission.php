<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $permission_id
 * @property integer $role_id
 * @property Permission $permission
 * @property Role $role
 */
class RoleHasPermission extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
