<?php
declare(strict_types=1);

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseFormRequest;

class OrderStoreRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*.weight' => 'required|numeric|min:0.01',
            'data.*.region' => 'required|integer|min:1',
            'data.*.delivery_hours' => 'required|array|min:1',
            'data.*.delivery_hours.*' => 'string|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'data.required' => 'Данные обязательны.',
            'data.array' => 'Данные должны быть массивом.',
            'data.*.weight.required' => 'Вес заказа обязателен.',
            'data.*.weight.numeric' => 'Вес заказа должен быть числом.',
            'data.*.weight.min' => 'Минимальный вес заказа — 0.01.',
            'data.*.region.required' => 'Регион обязателен.',
            'data.*.region.integer' => 'Регион должен быть целым числом.',
            'data.*.region.min' => 'Регион должен быть положительным числом.',
            'data.*.delivery_hours.required' => 'Часы доставки обязательны.',
            'data.*.delivery_hours.array' => 'Часы доставки должны быть массивом.',
            'data.*.delivery_hours.min' => 'Должен быть указан хотя бы один интервал времени.',
            'data.*.delivery_hours.*.string' => 'Каждый интервал времени должен быть строкой.',
            'data.*.delivery_hours.*.regex' => 'Неверный формат времени. Используйте HH:MM-HH:MM.',
        ];
    }
}
