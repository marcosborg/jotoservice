<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvdeMonth extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'tvde_months';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'year_id',
        'name',
        'number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function year()
    {
        return $this->belongsTo(TvdeYear::class, 'year_id');
    }

    public function weeks()
    {
        return $this->hasMany(TvdeWeek::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}