<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
              'first_name' => 'required|min:3|alpha_dash',
              'last_name' => 'required|min:3|alpha_dash',
              'email' => 'nullable|email',
              'mobile' => ['nullable', 'regex:/^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/'],
              'birthday' => 'nullable|date',
              'family_id' => 'required',
              'family_role_id' => 'required',
              'gender' => 'required',
              'user_id' => 'nullable|integer',
              'status_id' => 'required',
          ];
      }


      public function messages()
      {
          return [
              'first_name.required' => 'The first name is required, and it must be at least 3 characters long.',
              'status_id.required' => 'The status field is required.',
          ];
      }
}
