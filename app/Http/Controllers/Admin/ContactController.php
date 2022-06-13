<?php


namespace App\Http\Controllers\Admin;


use App\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        foreach ($contacts as $contact) {
            $contact->seen = 1;
            $contact->save();
        }

        return view('admin.contacts.index', compact(['contacts']));
    }
}