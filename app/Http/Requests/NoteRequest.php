<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
            'tag' => 'required',
            'files.*' => 'max:10000|mimes:jpeg,bmp,png,gif,pdf,zip,txt,docx,doc,xls,xlsx,numbers,pages',
        ];
    }
}
