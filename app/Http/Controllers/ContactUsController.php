<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\User;
use Illuminate\Http\Request;
use Mail;

class ContactUsController extends Controller
{
    // Show the contact form
    public function show()
    {
        return view('contact');
    }


    // Send email
    public function sendEmail(Request $request)
    {
        // Flash a success message to the session
        /*$request->flash();*/
        // Validate form
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);
        $users = User::get();
        // Send email
        $email = new ContactMail($request, $users);
        /*return $email; om snel de mail te kunnen zien */
        // return $email;       // uncomment this line to display the result in the browser
        Mail::to($request)      // or Mail::to($request->email, $request->name)
        ->send($email);
        // Flash filled-in form values to the session
        session()->flash('success', 'Thank you for your message.<br>We\'ll contact you as soon as possible.');

        // Redirect to the contact-us link ( NOT to view('contact')!!! )

        return redirect('contact-us');
    }
}
