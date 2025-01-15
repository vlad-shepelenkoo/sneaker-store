<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Models\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function contacts(){
        $contacts = Contact::sortBy('created_at', 'DESC')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function contact_details($id){
        $contact = Contact::find($id);
        return  view('admin.contact-details', compact('contact'));
    }

    public function contact_update($id){
        $contact = Contact::find($id);
        $contact->read = Constants::READ_MESSAGE;
        $contact->save();
        return back()->with('status', 'The message has been read!');
    }

    public function contact_delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with('status', 'Contact deleted successfully');
    }
}