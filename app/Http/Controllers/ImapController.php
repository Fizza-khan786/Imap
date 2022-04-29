<?php

namespace App\Http\Controllers;
use Webklex\IMAP\Facades\Client;
use Webklex\IMAP\Support\MessageCollection;
use Webklex\PHPIMAP\Support\FolderCollection;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
class ImapController extends Controller
{
    public function getEmail(){
       
        
            $oClient = Client::account('default');
           
            $oClient->connect();
            $aFolder = $oClient->getFolder('INBOX');
            // getMessages
            // ->markAsRead()
            // $aMessage = $aFolder->messages()->get();
            $messages = $aFolder->messages()->all()->get();
            //  dd($messages);
            //  return view('mailbox',['subject'=>'$subject']);

            return view('mailbox')->with(compact('messages'));
    }


    public function readMail(){
        return view('mailbox')->with(compact('messages'));

    }
}