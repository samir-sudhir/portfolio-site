<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Mail\ContactFormMail;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Get all contact messages (viewable by admin only)
    public function index()
    {
        $contacts = Contact::all();
        return Helper::result('Contact messages retrieved successfully', 200, $contacts);
    }

    // Show a specific contact message
    public function show(Contact $contact)
    {
        return Helper::result('Contact message retrieved successfully', 200, $contact);
    }

    // Store a new contact message (public route for users to submit)
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Ensure 'company' is not null
        $validated['company'] = $validated['company'] ?? 'N/A';

        // Create a new contact message
        $contact = Contact::create($validated);

        // Fetch admin email from users table or use hardcoded fallback
        $adminEmail = User::find(1)->email ?? 'admin@example.com';

        // Send email to admin
        Mail::to($adminEmail)->send(new ContactFormMail($contact));

        // Return response with full contact details
        return Helper::result('Contact message sent successfully', 201, [
            'id' => $contact->id,
            'first_name' => $contact->first_name,
            'last_name' => $contact->last_name,
            'email' => $contact->email,
            'phone_number' => $contact->phone_number,
            'company' => $contact->company,
            'country' => $contact->country,
            'message' => $contact->message,
            'created_at' => $contact->created_at,
            'updated_at' => $contact->updated_at,
        ]);
    }

    // Update a contact message (admin only)
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_no' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact->update($validated);

        return Helper::result('Contact message updated successfully', 200, $contact);
    }

    // Delete a contact message (admin only)
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return Helper::result('Contact message deleted successfully', 200);
    }
}
