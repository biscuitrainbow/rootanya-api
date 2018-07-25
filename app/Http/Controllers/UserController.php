<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Medicine;
use App\UserHasNotification;
use App\UserHasMedicine;
use App\Http\Controllers\Api\ApiController;

class UserController extends ApiController
{
    public function getNotifications(User $user, Request $request)
    {
        $medicines = $user->notifications()->get();

        $uq_medicines = $medicines->unique('id')->values();

        $uq_medicines->map(function ($med) {
            $med->notifications;
            return $med;
        });

        $uq_medicines->forget('pivot');

        return $uq_medicines;
    }


    public function getNotificationsByMedicine(User $user, Medicine $medicine)
    {
        $notifications = $medicine->notifications->filter(function ($n) use ($user) {
            return $n->users_id == $user->id;
        });

        $medicine->user_notifications = $notifications;

        return $medicine;
    }

    public function addNotification(Request $request, User $user, Medicine $medicine)
    {

        $at = $request->at;
        $uuid = $request->uuid;

        return UserHasNotification::create([
            'users_id' => $user->id,
            'medicines_id' => $medicine->id,
            'at' => $at,
            'uuid' => $uuid,
        ]);
    }

    public function deleteNotification(UserHasNotification $noti)
    {
        $noti->delete();

        return $this->respondSuccess();
    }


    public function getUsages(Request $request, User $user)
    {
        $usages = $user->usages;

        $usages = $usages->map(function ($usage) {
            $usage->usage_id = (int)$usage->pivot->id;
            $usage->volume = (int)$usage->pivot->volume;
            $usage->usage_date = $usage->pivot->created_at->toDateTimeString();

            return $usage;
        });

        return $usages;
    }


    public function createUsage(Request $request, User $user)
    {
        $medicine_id = $request->medicine_id;
        $volume = $request->volume;


        return UserHasMedicine::create([
            'users_id' => $user->id,
            'medicines_id' => $medicine_id,
            'volume' => $volume,
        ]);
    }

    public function deleteUsage(UserHasMedicine $history)
    {
        $history->delete();

      //  return $this->respondSuccess();
        return [];
    }


    public function updateUsage(UserHasMedicine $history, Request $request)
    {
        $history->update([
            'volume' => $request->volume
        ]);

        return [];

      //  return $this->respondSuccess();
    }


    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        $user->age = (int)$user->age;
        $user->weight = (int)$user->weight;
        $user->height = (int)$user->height;

        return $this->respond($user);
    }
}
