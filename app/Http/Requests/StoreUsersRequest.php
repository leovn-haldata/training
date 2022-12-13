<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreUsersRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;

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
            'email' => ['required', 'string', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function isExitsUser()
    {
        $isExist = User::select("*")
            ->where("email", $this->input('email'))
            ->exists();

        if ($isExist) {
            throw ValidationException::withMessages([
                'email' => trans('auth.email_exists'),
            ]);
        }
    }
}
