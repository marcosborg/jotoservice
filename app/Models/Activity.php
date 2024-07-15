<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const ICON_SELECT = [
        'fas fa-car-alt icon'           => 'fas fa-car-alt icon',
        'fas fa-user-tag icon'          => 'fas fa-user-tag icon',
        'fas fa-search-dollar icon'     => 'fas fa-search-dollar icon',
        'fas fa-parachute-box icon'     => 'fas fa-parachute-box icon',
        'fas fa-chalkboard-teacher icon'=> 'fas fa-chalkboard-teacher icon',
        'fas fa-shopping-cart icon'     => 'fas fa-shopping-cart icon',
        'fas fa-bus icon'               => 'fas fa-bus icon',
    ];

    public $table = 'activities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'button',
        'link',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
