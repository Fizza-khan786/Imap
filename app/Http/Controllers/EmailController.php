<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use App\Models\Attachment;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail(Request $req){
        $email=new Email;
        $email->recipient=$req->recipient;
        $email->subject=$req->subject;
        $email->body=$req->body;
        $email->save();
        $data=$req->body;
        if($req->hasfile('attachment'))
        {
            Mail::send('email', ['data' => $data], function($message)use($req,$email) {
                $message->to($req->recipient)
                        ->subject($req->subject);
                foreach($req->file('attachment') as $file)
                {
                $emailAttach    = new Attachment;
                $emailAttach->email_id  = $email->id;
                $name = $file->getClientOriginalName();
                $file->move(public_path() . 'uploads', $name);
                 $final = (public_path('uploads/') . $name);
                $emailAttach->attachment = $name;
                $emailAttach->save();
                $message->attach($final);
                }
            });
        }
        else{
            Mail::send('email', ['data' => $data], function ($message) use ($req) {
                $message->to($req->recipient)
                        ->subject($req->subject);
            });
        }
        //  $attachment=$req->file('attachment');
        return redirect()->route('compose');

    }
}
