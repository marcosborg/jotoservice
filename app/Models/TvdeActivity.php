<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvdeActivity extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tvde_activities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tvde_week_id',
        'tvde_operator_id',
        'company_id',
        'driver_code',
        'earnings_one',
        'earnings_two',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tvde_week()
    {
        return $this->belongsTo(TvdeWeek::class, 'tvde_week_id');
    }

    public function tvde_operator()
    {
        return $this->belongsTo(TvdeOperator::class, 'tvde_operator_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
