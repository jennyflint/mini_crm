<?php

namespace App\Http\Requests;

class CompanyRequest extends AbstractRequest
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
            'clients' => 'array|exists:clients,id,user_id,' . auth()->user()->id,
        ];
    }
}
