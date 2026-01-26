<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'nullable|max:150',  // Optional, if you add it to the form later
        ]);

        // Insert into contacts table
        Contact::create([
            'user_id' => Auth::id(),  // Logged-in user ID or null if guest
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,  // Optional
            'message' => $validated['message'],
            'date_sent' => now(),
            'status' => 'pending',  // Default status
        ]);

        return back()->with('success', 'Thank you! Your message has been submitted.');
    }
}