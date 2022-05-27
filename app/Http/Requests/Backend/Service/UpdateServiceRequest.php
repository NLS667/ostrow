<?php

namespace App\Http\Requests\Backend\Service;

use App\Http\Requests\Request;

/**
 * Class UpdateServiceRequest.
 */
class UpdateServiceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-service');
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
            'offered_at'        => 'nullable|date:d/m/Y',
            'signed_at'         => 'nullable|date:d/m/Y',
            'installed_at'      => 'nullable|date:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'    => 'Musisz wybrać Klienta.',
            'service_cat_id.required' => 'Musisz wybrać rodzaj Usługi.',
            'model_id.required' => 'Musisz wybrać Model urządzenia.',
            'offered_at.date' => 'Musisz podać prawidłową datę.',
            'signed_at.date' => 'Musisz podać prawidłową datę.',
            'installed_at.date' => 'Musisz podać prawidłową datę.',
        ];
    }
}
