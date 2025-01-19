<?php

namespace App\Observers;

use App\Models\MemberReview;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class MemberReviewActionObserver
{
    public function created(MemberReview $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'MemberReview'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
