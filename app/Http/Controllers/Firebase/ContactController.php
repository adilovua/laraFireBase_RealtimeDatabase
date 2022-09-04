<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Contract\Auth;

class ContactController extends Controller
{

    public function __construct(Database $database, Messaging $messaging, Auth $auth)
    {
        $this->database = $database;
        $this->tableName = 'contacts';
        $this->messaging = $messaging;
        $this->auth = $auth;
    }

    public function index(){


        $contacts = $this->database->getReference($this->tableName)->getValue();
        $total_contacts = $this->database->getReference($this->tableName)->getSnapshot()->numChildren();

        return view('firebase.contact.index', [
            'contacts'=>$contacts,
                'total_contacts'=>$total_contacts
        ]);
    }

    public function create(){
        return view('firebase.contact.create');
    }

    public function store(Request $request){

        $contactData = [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
        ];
        $postRef = $this->database->getReference($this->tableName)->push($contactData);

        if ($postRef) {

            $title = 'My Notification Title';
            $body = 'My Notification Body';
            $imageUrl = 'http://lorempixel.com/400/200/';
            $notification = Notification::fromArray([
                'title' => $title,
                'body' => $body,
                'image' => $imageUrl,
            ]);


                $deviceToken = 'egyAouq2KQCu9WhDo1Yxp_:APA91bHqnlE981nHuGmS2dbkTtBBPp-Kqo7CkpFEZkoDuoEpC-ZjtHss9k5GVp_gKTxEu3EvswVLG2ziSoyCW5a3j_40r7aBQ7b8r4wN0S0FzxdfLseraj7sr26pEqO-cYuJYesNs24b';
            $topic = 'a-topic';
            $config = WebPushConfig::fromArray([
                'notification' => $notification,
                'fcm_options' => [
                    'link' => 'https://my-server/some-page',
                ],
            ]);

            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification($notification);

            try {
                    $this->messaging->send($message);
                }
            catch (InvalidMessage $e) {
                return ($e->errors());
            }

            return redirect('contacts')->with('status', 'Contact added successfully!');
        }
        else {
            return redirect('contacts')->with('status', 'Contact not added!');
        }
    }

    public function edit($id){
        $contact = $this->database->getReference($this->tableName)->getChild($id)->getValue();
        if ($contact) {
            return view('firebase.contact.edit', [
                'contact' => $contact,
                'id' => $id,
            ]);
        }
        else
            return redirect('contacts')->with('status', 'Contact ID not found!');
    }

    public function update(Request $request, $id) {

        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,];
        $contactUpdate = $this->database->getReference($this->tableName.'/'.$id)->update($updateData);

        if ($contactUpdate) {
            return redirect('contacts')->with('status', 'Contact updated successfully!');
        }
        else
        {
            return redirect('contacts')->with('status', 'Coud not update the Contact!');
        }

    }

    public function destroy($id){
       $delData = $this->database->getReference($this->tableName.'/'.$id)->remove();

       if ($delData) {
           return redirect('contacts')->with('status', 'Contact deleted successfully!');
       }
       else
       {
           return redirect('contacts')->with('status', 'Coud not delete the Contact!');
       }
    }
}
