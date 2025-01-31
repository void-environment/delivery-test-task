<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Http\Requests\Courier\CourierStoreRequest;
use App\Http\Requests\Courier\CourierUpdateRequest;

use App\Http\Responses\Courier\CourierShowResponse;
use App\Http\Responses\Courier\CourierStoreResponse;
use App\Http\Responses\Courier\CourierUpdateResponse;
use App\Http\Responses\NotFoundResponse;

/**
 * Контроллер управления курьерами.
 */
class CourierController extends Controller
{
    /**
     * Создание новых курьеров.
     *
     * @param CourierStoreRequest $request Входной запрос с данными курьеров.
     * @return CourierStoreResponse Ответ с данными созданных курьеров.
     */
    public function store(CourierStoreRequest $request): CourierStoreResponse
    {
        $couriers = collect($request->input('data'))
            ->map(fn($courier) => Courier::create($courier))
            ->all();

        return new CourierStoreResponse($couriers);
    }

     /**
     * Получение данных о курьере по ID.
     *
     * @param int $id идентификатор курьера.
     * @return CourierShowResponse|NotFoundResponse ответ с данными курьера или ошибка 404.
     */
    public function show(int $id): CourierShowResponse | NotFoundResponse 
    {
        $courier = Courier::find($id);

        if (!$courier) {
            return new NotFoundResponse();
        }

        return new CourierShowResponse($courier);
    }

    /**
     * Обновление данных курьера по ID.
     *
     * @param CourierUpdateRequest $request запрос с обновлёнными данными.
     * @param int $id Идентификатор курьера.
     * @return CourierUpdateResponse|NotFoundResponse ответ с обновлёнными данными или ошибка 404.
     */
    public function update(CourierUpdateRequest $request, int $id): CourierUpdateResponse | NotFoundResponse
    {
        $courier = Courier::find($id);

        if (!$courier) {
            return new NotFoundResponse();
        }

        $validated = $request->validated(); 
        $courier->update($validated); 

        return new CourierUpdateResponse($courier);
    }
}
  