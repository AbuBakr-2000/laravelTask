<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files',$name,'public');
        };

        $validated = $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file_url' => 'file|mimes:jpg,png,pdf,doc,docx',
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

//        ============== queue ===============
        SendEmailJob::dispatch($application);

        return redirect()->back()->with(['success' => 'Has been send!']);
    }
}
