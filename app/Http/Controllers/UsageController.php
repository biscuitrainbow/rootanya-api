<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsageController extends Controller
{
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
}
