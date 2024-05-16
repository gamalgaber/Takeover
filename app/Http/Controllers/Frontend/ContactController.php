<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function contact(): view
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.contact', compact('categories'));
    }

    public function handleContactForm(Request $request): Response
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
