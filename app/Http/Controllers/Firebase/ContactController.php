<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ContactController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tableName = 'contacts';
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
