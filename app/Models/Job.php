<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * @property int $id
 * @property int $user_id
 * @property int $job_category_id
 * @property int $job_industry_id
 * @property string $uuid
 * @property string $title
 * @property string $description 
 * @property string $email_apply
 * @property string $location
 * @property string $working_time
 * @property string $salary
 * @property string $company
 * @property int $active
 * @property int $archived
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property JobCategory $jobCategory
 * @property JobIndustry $jobIndustry
 * @property User $user
 */
class Job extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'job_category_id', 'job_industry_id', 'uuid', 'email_apply', 'title', 'description', 'location', 'working_time', 'salary', 'company', 'active', 'archived', 'status', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobCategory()
    {
        return $this->belongsTo('App\Models\JobCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobIndustry()
    {
        return $this->belongsTo('App\Models\JobIndustry');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
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
