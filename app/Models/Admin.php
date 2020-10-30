<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'order',
        'is_active',
        'password',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function setPasswordAttribute($value)
    {
        if($value != "" || $value != null){
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
