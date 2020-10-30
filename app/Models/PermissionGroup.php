<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;

class PermissionGroup extends BaseModel
{
    public $translatedAttributes = ['name'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
