<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'documents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'driver_id',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'citizen_card',
        'tvde_driver_certificate',
        'criminal_record',
        'profile_picture',
        'driving_license',
        'iban',
        'address',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function getCitizenCardAttribute()
    {
        return $this->getMedia('citizen_card');
    }

    public function getTvdeDriverCertificateAttribute()
    {
        return $this->getMedia('tvde_driver_certificate');
    }

    public function getCriminalRecordAttribute()
    {
        return $this->getMedia('criminal_record');
    }

    public function getProfilePictureAttribute()
    {
        $file = $this->getMedia('profile_picture')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getDrivingLicenseAttribute()
    {
        return $this->getMedia('driving_license');
    }

    public function getIbanAttribute()
    {
        return $this->getMedia('iban');
    }

    public function getAddressAttribute()
    {
        return $this->getMedia('address');
    }
}