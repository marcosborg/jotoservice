<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferForm extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'transfer_forms';

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
        'rgpd',
        'transfer_tour_id',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transfer_tour()
    {
        return $this->belongsTo(TransferTour::class, 'transfer_tour_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
