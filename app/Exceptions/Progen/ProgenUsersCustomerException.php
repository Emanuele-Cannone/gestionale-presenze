<?php

namespace App\Exceptions\Progen;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProgenUsersCustomerException extends Exception
{
    public function render(Request $request): RedirectResponse
    {
        Session::flash('error_message', __('progen.customer.users.users_not_associated')); 
        return Redirect::route('progen.index');
    }
}
