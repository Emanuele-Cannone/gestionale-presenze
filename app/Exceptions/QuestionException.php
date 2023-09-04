<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class QuestionException extends Exception
{
    public function render(Request $request): RedirectResponse
    {
        Session::flash('error_message', __('attendance.error')); 
        return Redirect::route('rosters.index');
    }
}
