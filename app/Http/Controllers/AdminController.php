<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Contact;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        // Simple password check (in production, use proper authentication)
        if ($request->password === 'admin123') {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome to admin dashboard!');
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('home')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        $stats = [
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'unread')->count(),
            'contacts_today' => Contact::whereDate('created_at', today())->count(),
            'contacts_this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        $recent_contacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }

    public function contacts()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function showContact(Contact $contact)
    {
        // Mark as read when viewed
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contact-detail', compact('contact'));
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['status' => 'read']);
        return back()->with('success', 'Message marked as read');
    }

    public function deleteContact(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully');
    }
}
