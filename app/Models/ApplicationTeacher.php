<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationTeacher extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'qualification_id',
        'male_count',
        'female_count'
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * boot
     */
    protected static function boot ()
    {
    	parent::boot();

        $userId = auth()->id();
        static::creating(function ($model) use ($userId) {
            $model->uuid = (string) \Uuid::generate(4);
            if (!$model->created_by) {
                $model->created_by = $userId;
            }
            if (!$model->updated_by) {
                $model->updated_by = $userId;
            }
        });

        static::updating(function ($model) use ($userId) {
            $model->updated_by = $userId;
        });
    }
}
