<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SentPost extends Model
{
    protected $fillable = [
        'post_id',
        'subscriber_id'
    ];

    protected $casts = [
        'post_id' => 'int',
        'subscriber_id' => 'int'
    ];

    /**
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
