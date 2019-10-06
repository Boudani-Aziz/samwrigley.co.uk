<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Log::info("Contact: {$request->email}");

        return Redirect::back()->with('contact', 'Thank you for getting in touch!');
    }
}
