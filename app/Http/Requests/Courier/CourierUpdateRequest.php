<?php
declare(strict_types=1);

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;

class CourierUpdateRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'courier_type' => 'required|string|in:foot,bike,car',
            'regions' => 'required|array|min:1',
            'regions.*' => 'required|integer|min:1',
            'working_hours' => 'required|array|min:1',
            'working_hours.*' => 'required|string|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'courier_type.required' => 'Тип курьера обязателен.',
            'courier_type.in' => 'Тип курьера должен быть одним из: foot, bike, car.',
            'regions.required' => 'Список регионов обязателен.',
            'regions.array' => 'Регионы должны быть массивом.',
            'regions.min' => 'Должен быть указан хотя бы один регион.',
            'regions.*.required' => 'ID региона обязателен.',
            'regions.*.integer' => 'ID региона должен быть числом.',
            'regions.*.min' => 'ID региона должен быть положительным числом.',
            'working_hours.required' => 'Часы работы обязательны.',
            'working_hours.array' => 'Часы работы должны быть массивом.',
            'working_hours.min' => 'Должен быть указан хотя бы один интервал времени.',
            'working_hours.*.required' => 'Интервал времени обязателен.',
            'working_hours.*.string' => 'Каждый интервал времени должен быть строкой.',
            'working_hours.*.regex' => 'Неверный формат времени. Используйте HH:MM-HH:MM.',
        ];
    }
}
