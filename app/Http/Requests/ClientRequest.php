<?php

namespace App\Http\Requests;

class ClientRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email',
        ];
    }
}
