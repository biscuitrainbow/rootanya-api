<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\User;

class MedicineController extends Controller
{

    public function getMedicineByQuery(User $user, Request $request)
    {
        if ($request->q == '') return array();

        $medicines = Medicine::where('barcode', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%' . $request->q . '%')
            ->orWhere('ingredient', 'like', '%' . $request->q . '%')
            ->orWhere('category', 'like', '%' . $request->q . '%')
            ->orWhere('type', 'like', '%' . $request->q . '%')
            ->orWhere('for', 'like', '%' . $request->q . '%')
            ->get();

        $medicines = $medicines->filter(function ($medicine) use ($user) {
            return $medicine->user_id == $user->id || $medicine->user_id == null;
        });

        return $medicines;
    }

    public function createByUser(User $user, Request $request)
    {
        return Medicine::create($request->all());
    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return Medicine::where('user_id', null)->orWhere('user_id', $user->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}
