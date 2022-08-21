<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotficateController extends Controller
{
   public function mysender(){
    return view('firebase.service.notification');
   }
}
