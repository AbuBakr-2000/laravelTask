<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        if ($this->checkDate())
        {
            return redirect()->back()->with(['message' => 'You can send only 1 application in a day']);
        }

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

    protected function checkDate()
    {
        if (auth()->user()->apps()->latest()->first() == null)
        {
            return false;
        }

        $lastApp = auth()->user()->apps()->latest()->first();
        $lastAppDate = Carbon::parse($lastApp->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($lastAppDate == $today)
        {
            return true;
        }
    }
}
