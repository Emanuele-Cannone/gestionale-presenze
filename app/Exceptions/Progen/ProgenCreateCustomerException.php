<?php

namespace App\Exceptions\Progen;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProgenCreateCustomerException extends Exception
{
    public function render(Request $request): RedirectResponse
    {
        Session::flash('error_message', __('progen.customer.form_new_customer.error')); 
        return Redirect::route('progen.create');
    }
}
