<?php

namespace App\Http\Controllers;

use App\Translation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        //$user = User::find(auth())
        //auth()->user()->attachPermission('superadmin');

        $user = User::find(auth()->user()->id);
        dump($user->hasPermissionTo('superadmin'));

    }
}
