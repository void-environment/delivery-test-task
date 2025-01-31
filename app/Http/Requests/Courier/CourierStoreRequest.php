<?php
declare(strict_types=1);

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;

class CourierStoreRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*.courier_type' => 'required|string|in:foot,bike,car',
            'data.*.regions' => 'required|array',
            'data.*.regions.*' => 'required',
            'data.*.working_hours' => 'required|array|min:1',
            'data.*.working_hours.*' => 'string|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'data.required' => 'Данные обязательны.',
            'data.array' => 'Данные должны быть массивом.',
            'data.*.courier_type.required' => 'Тип курьера обязателен.',
            'data.*.courier_type.in' => 'Тип курьера должен быть одним из: foot, bike, car.',
            'data.*.regions.required' => 'Список регионов обязателен.',
            'data.*.regions.array' => 'Регионы должны быть массивом.',
            'data.*.regions.min' => 'Должен быть указан хотя бы один регион.',
            'data.*.regions.*.min' => 'ID региона должен быть положительным числом.',
            'data.*.working_hours.required' => 'Часы работы обязательны.',
            'data.*.working_hours.array' => 'Часы работы должны быть массивом.',
            'data.*.working_hours.min' => 'Должен быть указан хотя бы один интервал времени.',
            'data.*.working_hours.*.string' => 'Каждый интервал времени должен быть строкой.',
            'data.*.working_hours.*.regex' => 'Неверный формат времени. Используйте HH:MM-HH:MM.',
        ];
    }
}
