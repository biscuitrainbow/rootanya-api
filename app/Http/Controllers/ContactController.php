<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\ApiController;

class ContactController extends ApiController
{

    public function __construct()
    {
        
    }

    public function index(User $user)
    {
        return $user->contacts;
    }


    public function store(User $user, Request $request)
    {
        return $user->contacts()->save(new Contact($request->all()));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());

        return $this->respondSuccess();
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $this->respondSuccess();
    }
}
