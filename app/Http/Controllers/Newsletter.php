<?php

namespace App\Http\Controllers;

use Spatie\Newsletter\Facades\Newsletter as FacadesNewsletter;
use Illuminate\Http\Request;

class Newsletter extends Controller
{
    public function subscribe(Request $request)  {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        FacadesNewsletter::subscribeOrUpdate($request->input('email'));

        return back()->with('message', 'You have succesfully subscribed to our newsletter!');
    }
}
