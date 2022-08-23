<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotficateController extends Controller
{
    public function NotificationForm(){
        return view('firebase.service.notification');
    }
   public function mysender(){
        return redirect('notificate')->with('status', 'Notification sent successfully!!');
   }
}
