<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model {

    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'application_type_id',
        'district_id',
        'tehsil_id',
        'college_name',
        'college_address',
        'city_id',
        'college_email',
        'college_phone_no',
        'uc_no',
        'pp_no',
        'na_no',
        'education_level_id',
        'gender_id',
        'location_id',
        'gender_registered_id',
        'shift_id',
        'establishment_year',
        'registration_date',
        'last_renewal_date',
        'affiliation',
        'affiliated_university_name',
        'nature_of_ownership_id',
        'registration_status',
        'owner_name',
        'owner_principal_manager_phone_no',
        'principal_cnic',
        'total_male_teachers',
        'total_female_teachers',
        'total_classrooms',
        'total_rooms_other_than_classrooms',
        'area_type_id',
        'area_value',
        'has_library',
        'total_books',
        'hygiene_certificate',
        'building_fitness_certificate',
        'map_of_college_building',
        'ownership_rent_deed',
        'last_fee_receipt',
        'fee_status',
        'fee_payment_date',
        'status'
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

    /**
     * belongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Application has many labs
     */
    public function labs()
    {
        return $this->hasMany(ApplicationLab::class, 'application_id');
    }

    /**
     * Application has many teachers
     */
    public function application_teachers()
    {
        return $this->hasMany(ApplicationTeacher::class, 'application_id');
    }

    /**
     * Application has many enrollment
     */
    public function application_enrollments()
    {
        return $this->hasMany(ApplicationEnrollment::class, 'application_id');
    }
}
