<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendEmail($requestId)
    {
        $request = ModelsRequest::findOrFail($requestId);
        $email = $request->raisedTo->email;

        Mail::to($email)->send(new PaymentMail($request));
        return redirect()->route('request.index')->with('message', 'Email Sent Successfully');;
    }
}
