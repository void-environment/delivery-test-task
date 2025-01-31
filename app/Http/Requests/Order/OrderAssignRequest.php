<?php
declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseFormRequest;

class OrderAssignRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'courier_id' => 'required|integer|exists:couriers,id',
            'order_id' => 'required|integer|exists:orders,id',
        ];
    }

    public function messages(): array
    {
        return [
            'courier_id.required' => 'ID курьера обязателен.',
            'courier_id.integer' => 'ID курьера должен быть числом.',
            'courier_id.exists' => 'Указанный курьер не найден.',

            'order_id.required' => 'ID заказа обязателен.',
            'order_id.integer' => 'ID заказа должен быть числом.',
            'order_id.exists' => 'Указанный заказ не найден.',
        ];
    }
}
