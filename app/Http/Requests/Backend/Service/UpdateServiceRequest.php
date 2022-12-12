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
        $serviceCat = ServiceCategory::where('id', $this['service_cat_id'])->first();
        $type = $serviceCat->type;
        if($type == 'Zwykła')
        {
            return [
                'client_id'         => 'required',
                'service_cat_id'    => 'required',
                'models.*'          => 'required',
                'deal_amount'       => 'required',
                'advance_date.*'    => 'required|date',
                'deal_advance.*'    => 'required|filled',
                'offered_at'        => 'required|date:d/m/Y',
                'signed_at'         => 'required|date:d/m/Y',
                'installed_at'      => 'nullable|date:d/m/Y',
            ];
        } else {
            return [
                'client_id'         => 'required',
                'service_cat_id'    => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'client_id.required'    => 'Musisz wybrać Klienta.',
            'service_cat_id.required' => 'Musisz wybrać rodzaj Usługi.',
            'offered_at.date' => 'Musisz podać prawidłową datę.',
            'offered_at.required' => 'Musisz podać datę oferty.',
            'deal_amount.required' => 'Musisz podać wartość umowy.',
            'advance_date.*.required' => 'Musisz podać datę wpłacenia zaliczki.',
            'advance_date.*.date' => 'Musisz podać prawidłową datę.',
            'deal_advance.*.required' => 'Musisz podać kwotę zaliczki.',
            'deal_advance.*.filled' => 'Kwota zaliczki nie może być pusta.',
            'models.*.required' => 'Musisz wybrać jakieś urządzenie.',
            'signed_at.date' => 'Musisz podać prawidłową datę.',
            'signed_at.required' => 'Musisz podać datę podpisania umowy.',
        ];
    }
}
