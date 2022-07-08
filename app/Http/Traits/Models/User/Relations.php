<?php

namespace App\Http\Traits\Models\User;

trait Relations
{
    public function authUserToken()
    {
        return $this->hasMany('App\Models\OAuthAccessToken');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City'::class, 'id', 'city_id');
    }

    public function born_place()
    {
        return $this->hasOne('App\Models\City'::class, 'id', 'born_place_id');
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role'::class, 'id', 'role_id');
    }

    public function tax_class()
    {
        return $this->hasOne('App\Models\TaxClass'::class, 'id', 'tax_class_id');
    }

    public function nation()
    {
        return $this->hasOne('App\Models\Nation'::class, 'id', 'nation_id');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department'::class,  'id', 'department_id');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company'::class,  'id', 'company_id');
    }

    public function work_place()
    {
        return $this->hasOne('App\Models\WorkPlace'::class,  'id', 'work_place_id');
    }

    public function position()
    {
        return $this->hasOne('App\Models\Position'::class,  'id', 'position_id');
    }

    public function job()
    {
        return $this->hasOne('App\Models\Job'::class,  'id', 'job_id');
    }

    public function manager()
    {
        return $this->hasOne('App\Models\User'::class,  'id', 'manager_id');
    }

    public function emergency_contact()
    {
        return $this->hasMany('App\Models\EmergencyContact'::class,  'user_id', 'id');
    }

    public function education_info()
    {
        return $this->hasMany('App\Models\EducationInfo'::class,  'user_id', 'id');
    }

    public function certificate()
    {
        return $this->hasMany('App\Models\Certificate'::class,  'user_id', 'id');
    }

    public function foreign_language()
    {
        return $this->hasMany('App\Models\ForeignLanguage'::class,  'user_id', 'id');
    }

    public function work_experience()
    {
        return $this->hasMany('App\Models\WorkExperience'::class,  'user_id', 'id');
    }

    public function reference()
    {
        return $this->hasMany('App\Models\Reference'::class,  'user_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_perms', 'user_id');
    }

    public function perms()
    {
        return $this->hasMany('App\Models\UserPerm'::class,  'user_id', 'id');
    }

    public function document()
    {
        return $this->hasOne('App\Models\Document'::class,  'user_id', 'id');
    }

    public function absence()
    {
        return $this->hasMany('App\Models\Absence'::class,  'user_id', 'id');
    }

    public function documentWithParameter($id)
    {
        return $this->document()->where('type_id', $id);
    }
}
