<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewRequest extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'new_requests';

    protected $dates = [
        'available_from',
        'available_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'New'       => 'New',
        'Accepted'  => 'Accepted',
        'Ongoing'   => 'Ongoing',
        'Rejected'  => 'Rejected',
        'Completed' => 'Completed',
    ];

    protected $fillable = [
        'pet_id',
        'available_from',
        'available_to',
        'credits',
        'status',
        'booked_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function getAvailableFromAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setAvailableFromAttribute($value)
    {
        $this->attributes['available_from'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getAvailableToAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setAvailableToAttribute($value)
    {
        $this->attributes['available_to'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function booked_by()
    {
        return $this->belongsTo(User::class, 'booked_by_id');
    }
}
