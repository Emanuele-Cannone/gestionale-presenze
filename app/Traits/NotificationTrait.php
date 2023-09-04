<?php

namespace App\Traits;
use App\Models\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


trait NotificationTrait {

    /**
     * Summary of setRead
     * @param Collection $ids
     * @return void
     */
    public function setReadNotification(collection $ids): void
    {
        
        Notification::wherein('question_id', $ids)
            ->whereJsonContains('users_to->'.Auth::id(), ['read' => 0])
            ->update(['users_to->'.Auth::id().'->read' => 1]);

    }

}