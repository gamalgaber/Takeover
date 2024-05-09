<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.contact', compact('categories'));
    }

    public function handleContactForm(Request $request)
    {
        $request->validate([
            'name'=> ['required','max:50'],
            'email'=> ['required','email'],
            'phone'=> ['required','max:50'],
            'message'=> ['required','max:1000'],
        ]);

        $email = 'admin@gmail.com';
        Mail::to($email)->send(new Contact($request->message, $request->email));

        return response(['status'=>'success', 'message'=>'Mail send successfully!']);
    }
}
