<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeRequest extends FormRequest
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
            'codesNumber' => 'required|int|min:1',
            'codeLength' => 'required|int|min:4'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'codesNumber.required' => 'Podanie liczby kodów jest wymagane.',
            'codeLength.required' => 'Podanie długości kodu jest wymagane.',
            'codesNumber.int' => 'Ilość kodów musi być liczbą całkowitą.',
            'codeLength.int' => 'Długość kodu musi być liczbą całkowitą.',
            'codesNumber.min:1' => 'Musisz wygenerować co najmniej 1 kod.',
            'codeLength.min' => 'Kod musi się składać co najmniej z 4 znaków.',
        ];
    }
}
