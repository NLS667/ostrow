<?php

namespace App\Http\Requests\Backend\Client;

use App\Http\Requests\Request;

/**
 * Class ClientCoordsRequest.
 */
class ClientCoordsRequest extends Request
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
            'adr_country'       => 'required|nullable|max:191',
            'adr_region'        => 'nullable|max:191',
            'adr_zipcode'       => 'nullable|regex:/[0-9]{2}-[0-9]{3}/',
            'adr_city'          => 'required|nullable|max:191',
            'adr_street'        => 'required|nullable|max:191',
            'adr_street_nr'     => 'required|nullable|max:5',
            'adr_home_nr'       => 'nullable|max:5',
        ];
    }

    /**
     * Get the validation massages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'adr_country.required'       => 'Musisz podać państwo aby wyszukać koordynaty.',
            'adr_country.max'            => 'Długość max. 191 znaków.',
            'adr_region.max'             => 'Długość max. 191 znaków.',
            'adr_zipcode.regex'          => 'To nie jest prawidłowy kod pocztowy.',
            'adr_city.required'          => 'Musisz podać miasto aby wyszukać koordynaty.',
            'adr_city.max'               => 'Długość max. 191 znaków.',
            'adr_street.required'        => 'Musisz podać ulicę aby wyszukać koordynaty.',
            'adr_street.max'             => 'Długość max. 191 znaków.',
            'adr_street_nr.required'     => 'Musisz podać numer domu aby wyszukać koordynaty.',
            'adr_street_nr.numeric'      => 'Wpisz jedynie cyfry.',
            'adr_street_nr.max'          => 'Długość max. 5 znaków.',
            'adr_home_nr.max'            => 'Długość max. 5 znaków.',
        ];
    }
}
