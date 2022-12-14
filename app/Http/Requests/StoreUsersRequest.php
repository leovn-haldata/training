<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

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
            'password' => ['required', 'confirmed','required_with:password_confirmation|same:password_confirmation', Rules\Password::defaults()],
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
