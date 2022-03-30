<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'website_id',
        'body',
        'sent'
    ];

    protected $casts = [
        'website_id' => 'int',
        'sent' => 'bool'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function subscribers()
    {
        return $this->hasOneThrough(Subscriber::class, Website::class, 'id', 'website_id');
    }
}
