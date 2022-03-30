<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    protected $fillable = [
        'website_id',
        'email'
    ];

    protected $casts = [
        'website_id' => 'int'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
