<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Medicine;
use App\UserHasNotification;

class UserController extends Controller
{
    public function getNotifications(User $user,Request $request){
        $medicines = $user->notifications()->get();

        $uq_medicines = $medicines->unique('id')->values();

        $uq_medicines->map(function($med){
             $med->notifications;
             return $med;
        });

        $uq_medicines->forget('pivot');

        return $uq_medicines;
    }


    public function getNotificationsByMedicine(User $user,Medicine $medicine){
         $notifications = $medicine->notifications->filter(function($n) use ($user) {
            return $n->users_id == $user->id ;
         });

         $medicine->user_notifications = $notifications;

         return $medicine;
    }

    public function addNotification(Request $request,User $user,Medicine $medicine){

        $at = $request->at;
        $uuid = $request->uuid;

        return UserHasNotification::create([
            'users_id' => $user->id,
            'medicines_id' => $medicine->id,
            'at' => $at,
            'uuid' => $uuid,
        ]);
    }
}
