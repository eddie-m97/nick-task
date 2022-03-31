<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Post extends Model
{
    protected $fillable = [
        'website_id',
        'body',
        'processed'
    ];

    protected $casts = [
        'website_id' => 'int',
        'processed' => 'bool'
    ];

    /**
     * @return BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * @return HasOneThrough
     */
    public function subscribers()
    {
        return $this->hasOneThrough(Subscriber::class, Website::class, 'id', 'website_id');
    }
}
