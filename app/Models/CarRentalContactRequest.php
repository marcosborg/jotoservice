<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRentalContactRequest extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'car_rental_contact_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
        'tvde',
        'tvde_card',
        'car_id',
        'message',
        'rgpd',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
