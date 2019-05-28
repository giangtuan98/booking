<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Session;
class SendEmailController extends Controller
{
  
    public function sendConfirmCodeText(InfoRequest $request)
  {
    $code = Str::random(6);
    $data = array(
          'name' => $request->customername,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'confirmCodeText' => $code,
          'viewName' => 'email.sendConfirmCode',
          'subject' => 'Xác nhận đặt xe'
        );

    
  	Mail::to($data['email'])->send(new SendMail($data));
    return response()->json(array('success'=> true, 'confirm_code_text' => $code));
  }
}
