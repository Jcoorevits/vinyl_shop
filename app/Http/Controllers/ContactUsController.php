<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Validate form

        // Send email

        // Flash filled-in form values to the session

        // Redirect to the contact-us link ( NOT to view('contact')!!! )
        return $request;
        return redirect('contact-us');
    }
}
