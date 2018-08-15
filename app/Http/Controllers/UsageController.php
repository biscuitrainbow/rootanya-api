<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserHasMedicine;
use App\Http\Controllers\Api\ApiController;

class UsageController extends ApiController
{
    public function getUsages(Request $request)
    {
        $user = auth()->user();
        $usages = $user->usages;

        $usages = $usages->map(function ($usage) {
            $usage->usage_id = (int)$usage->pivot->id;
            $usage->volume = (int)$usage->pivot->volume;
            $usage->usage_date = $usage->pivot->created_at->toDateTimeString();

            return $usage;
        });

        return $usages;
    }


    public function createUsage(Request $request)
    {
        $this->validate($request, [
            'volume' => 'required|numeric',
            'medicine_id' => 'required|exists:medicines,id',
        ]);

        $user = auth()->user();
        $medicine_id = $request->medicine_id;
        $volume = $request->volume;

        return UserHasMedicine::create([
            'users_id' => $user->id,
            'medicines_id' => $medicine_id,
            'volume' => $volume,
        ]);
    }

    public function deleteUsage(Request $request, UserHasMedicine $usage)
    {
        $usage->delete();

        return $this->respondSuccess();
    }


    public function updateUsage(UserHasMedicine $usage, Request $request)
    {
        $this->validate($request, [
            'volume' => 'required|numeric',
        ]);

        $usage->update([
            'volume' => $request->volume
        ]);

        return $this->respondSuccess();
    }
}
