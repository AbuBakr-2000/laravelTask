<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
//    public function index()
//    {
//        $applications = Application::latest();
//        return view('dashboard',['applicatons' => $applications]);
//    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files',$name,'public');
        };

        $validated = $request->validate([
//           'user_id' => 'required',
            'subject' => 'required|max:255',
            'message' => 'required',
            'file_url' => 'file|mimes:jpg,png,pdf,doc,docx',
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
//            'fileName' => $request->$name,
            'file_url' => $path ?? null,``
        ]);

        return redirect()->back()->with(['success' => 'Has been send!']);
    }
}
