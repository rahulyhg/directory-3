<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
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
             'name' => 'required|min:3',
             'slug' => 'required',
             'status_id' => 'required',
             'photo' => 'file|mimes:jpeg,png',
         ];
     }


     public function messages()
     {
         return [
             'name.required' => 'The family name field is required, and it must be at least 3 characters long.',
             'slug.required' => 'The family slug field is required.',
             'status_id.required' => 'The status field is required.',
         ];
     }
}
