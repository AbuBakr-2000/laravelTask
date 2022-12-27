<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject' => 'required|max:255',
            'message' => 'required',
            'file_url' => 'file|mimes:jpg,png,pdf,doc,docx',
        ];
    }
}
