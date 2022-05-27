<?php

namespace App\Http\Requests\Backend\Service;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreServiceRequest.
 */
class StoreServiceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-service');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id'         => 'required',
            'service_cat_id'    => 'required',
            'model_id'          => 'required',
            'offered_at'        => 'required|date:DD/MM/YYYY',
            'signed_at'         => 'nullable|date',
            'installed_at'      => 'nullable|date',
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
            'client_id.required'    => 'Musisz wybrać Klienta.',
            'service_cat_id.required' => 'Musisz wybrać rodzaj Usługi.',
            'model_id.required' => 'Musisz wybrać Model urządzenia.',
            'offered_at.required' => 'Musisz podać datę złożenia oferty.',
            'offered_at.date' => 'Musisz podać prawidłową datę.',
            'signed_at.date' => 'Musisz podać prawidłową datę.',
            'installed_at.date' => 'Musisz podać prawidłową datę.',
        ];
    }
}
