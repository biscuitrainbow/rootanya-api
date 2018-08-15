<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
use App\UserHasNotification;
use App\Http\Controllers\Api\ApiController;

class NotificationController extends ApiController
{
    public function getNotifications(Request $request)
    {
        $user = auth()->user();
        $medicines = $user->notifications()->get();

        $unique_medicines = $medicines->unique('id')->values();
        $unique_medicines->map(function ($medicine) {
            $medicine->notifications;
            return $medicine;
        });


        return $unique_medicines;
    }


    public function getNotificationsByMedicine(User $user, Medicine $medicine)
    {
        $notifications = $medicine->notifications->filter(function ($n) use ($user) {
            return $n->users_id == $user->id;
        });

        $medicine->user_notifications = $notifications;

        return $medicine;
    }

    public function addNotification(Request $request)
    {
        $user = auth()->user();
        $medicine = Medicine::find($request->medicine_id);
        $at = $request->at;
        $uuid = $request->uuid;

        $notification = UserHasNotification::create([
            'users_id' => $user->id,
            'medicines_id' => $medicine->id,
            'at' => $at,
            'uuid' => $uuid,
        ]);

        return $this->respondCreated($notification);
    }

    public function deleteNotification(UserHasNotification $notification)
    {
        $notification->delete();
        return $this->respondSuccess();
    }
}
