<?php

namespace App\Http\Requests\Backend\Client;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreClientRequest.
 */
class StoreClientRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-client');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'      => 'required|max:255',
            'last_name'       => 'required|max:255',
            'email'           => 'email|max:255',
            'phone_nr'        => 'numeric|max:9',
            'adr_country'     => 'max:255',
            'adr_region'      => 'max:255',
            'adr_zipcode'     => 'max:255',
            'adr_city'        => 'max:255',
            'adr_street'      => 'max:255',
            'adr_street_nr'   => 'numeric|max:3',
        ];
    }

    /**
     * Get the validation massages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        //
    }
}
