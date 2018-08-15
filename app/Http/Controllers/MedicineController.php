<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Api\ApiController;

class MedicineController extends ApiController
{

    public function getMedicineByQuery(Request $request)
    {
        if ($request->q == '') return $this->respond([]);

        $user = auth()->user();
        $medicines = Medicine::where('barcode', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%' . $request->q . '%')
            ->orWhere('ingredient', 'like', '%' . $request->q . '%')
            ->orWhere('category', 'like', '%' . $request->q . '%')
            ->orWhere('type', 'like', '%' . $request->q . '%')
            ->orWhere('for', 'like', '%' . $request->q . '%')
            ->orderBy('name')
            ->get();

        $medicines = $medicines->filter(function ($medicine) use ($user) {
            return $medicine->user_id == $user->id || $medicine->user_id == null;
        });

        return $medicines;
    }

    public function createByUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'barcode' => 'required|min:3',
        ]);

        $user = auth()->user();

        $medicine = new Medicine($request->all());
        $user->medicines()->save($medicine);

        return $this->respondCreated($medicine);
    }


    public function index()
    {
        return Medicine::where('user_id', null)->orWhere('user_id', $user->id)->get();
    }
}
