<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PublicPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user, Request $request)
    {
        return view('public', [
            'user' => $user,
            'tags' => $user->tags()->orderBy('name', 'asc')->get(),
        ]);
    }
}
