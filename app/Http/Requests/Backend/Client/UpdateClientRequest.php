<?php

namespace App\Http\Requests\Backend\Client;

use App\Http\Requests\Request;

/**
 * Class UpdateClientRequest.
 */
class UpdateClientRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-client');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'        => 'required|max:191',
            'last_name'         => 'required|max:191',
            'email'             => 'required|email',
            'phone_nr'          => ['nullable', 'max:12', 'regex:/(?<!\w)(\(?(\+|00)?48\)?)?[ -]?\d{3}[ -]?\d{3}[ -]?\d{3}(?!\w)/'],
            'adr_country'       => 'nullable|max:191',
            'adr_region'        => 'nullable|max:191',
            'adr_zipcode'       => 'nullable|regex:/[0-9]{2}-[0-9]{3}/',
            'adr_city'          => 'nullable|max:191',
            'adr_street'        => 'nullable|max:191',
            'adr_street_nr'     => 'nullable|max:5',
            'adr_home_nr'       => 'nullable|max:5',
            'adr_lattitude'     => 'nullable',
            'adr_longitude'     => 'nullable',
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
            'first_name.required'        => 'To pole jest wymagane.',
            'first_name.max'             => 'Długość max. 191 znaków.',
            'last_name.required'         => 'To pole jest wymagane.',
            'last_name.max'              => 'Długość max. 191 znaków.',
            'email.required'             => 'To pole jest wymagane.',
            'email.email'                => 'Podaj prawidłowy adres email.',
            'phone_nr.max'               => 'Długość max. 12 znaków.',
            'phone_nr.regex'             => 'To nie jest prawidłowy numer telefonu.',
            'adr_country.max'            => 'Długość max. 191 znaków.',
            'adr_region.max'             => 'Długość max. 191 znaków.',
            'adr_zipcode.regex'          => 'To nie jest prawidłowy kod pocztowy.',
            'adr_city.max'               => 'Długość max. 191 znaków.',
            'adr_street.max'             => 'Długość max. 191 znaków.',
            'adr_street_nr.numeric'      => 'Wpisz jedynie cyfry.',
            'adr_street_nr.max'          => 'Długość max. 5 znaków.',
            'adr_home_nr.max'            => 'Długość max. 5 znaków.',
        ];
    }
}
