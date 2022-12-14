<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCustomerRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'customer_name' => ['required', 'string'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'tel_num' => ['required', 'max:14'],
            'address' => ['required', 'string'],
        ];
    }

    public function isExists()
    {
        $isExist = Customer::select("*")
            ->where("email", $this->input('email'))
            ->exists();

        if ($isExist) {
            throw ValidationException::withMessages([
                'email' => trans('auth.email_exists'),
            ]);
        }
    }
}
