<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SystemAlert;
use Illuminate\Notifications\Notification;

class NotifyService
{
    /**
     * Send a system alert to every user holding any of the given roles.
     *
     * @param  string|array  $roles
     */
    public static function roles($roles, string $title, string $message, ?string $url = null, string $icon = 'iconoir-bell', string $level = 'primary', ?int $exceptUserId = null): void
    {
        $users = User::role($roles)
            ->when($exceptUserId, fn ($query) => $query->where('id', '!=', $exceptUserId))
            ->get();

        static::send($users, $title, $message, $url, $icon, $level);
    }

    /**
     * Send a system alert to a specific user (or collection of users).
     */
    public static function send($notifiable, string $title, string $message, ?string $url = null, string $icon = 'iconoir-bell', string $level = 'primary'): void
    {
        if ($notifiable instanceof User) {
            $notifiable->notify(new SystemAlert($title, $message, $url, $icon, $level));

            return;
        }

        foreach ($notifiable as $user) {
            $user->notify(new SystemAlert($title, $message, $url, $icon, $level));
        }
    }
}
