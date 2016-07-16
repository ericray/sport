<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class ApiController extends Controller
{
    public function getUsers()
    {
        $users = User::all();

        return response($users,'200');
    }

    public function createUser(Request $request)
    {
        $this->validate($request,['name' => 'required']);

        $name = $request->get('name');
        $message = "usuario $name creado";

        return response($message,'201');
    }

    public  function algo()
    {
        return response('algo','200');
    }
}
