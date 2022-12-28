<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppsRequest;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('applications.index')
            ->with([
                'applications' => auth()->user()->apps()->latest()->paginate(4),
            ]);
    }

    public function store(StoreAppsRequest $request)
    {
        if ($this->checkDate())
        {
            return redirect()->back()->with(['message' => 'You can send only 1 application in a day']);
        }

        if ($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files',$name,'public');
        };

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
