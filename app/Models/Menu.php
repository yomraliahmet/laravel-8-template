<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'menu_id',
        'permission',
        'route',
        'url',
        'icon',
        'target'
    ];

    public $translatedAttributes = [
        'name',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function childrenMenus()
    {
        return $this->hasMany(Menu::class)->with(['menus' => function($query){
            $query->withTranslation()->orderBy("order","asc");
        }])->withTranslation()->orderBy("order","asc");
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
