<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
        'sent_by',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * The user this notification is for (null = broadcast to all).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The admin who sent this notification.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    /**
     * Scope: unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope: for a specific user (includes broadcasts).
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhereNull('user_id');
        });
    }
}
