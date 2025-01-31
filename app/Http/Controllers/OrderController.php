<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Courier;

use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Requests\Order\OrderAssignRequest;
use App\Http\Requests\Order\OrderCompleteRequest;

use App\Http\Responses\Order\OrderStoreResponse;
use App\Http\Responses\Order\OrderAssignResponse;
use App\Http\Responses\Order\OrderCompleteResponse;
use App\Http\Responses\NotFoundResponse;
use App\Http\Responses\NoContentResponse;

use Illuminate\Support\Carbon;

/**
 * Контроллер управления заказами.
 */
class OrderController extends Controller
{
    /**
     * Создание новых заказов.
     *
     * @param OrderStoreRequest $request запрос с данными заказов.
     * @return OrderStoreResponse ответ с данными созданных заказов.
     */
    public function store(OrderStoreRequest $request): OrderStoreResponse
    {
        $orders = collect($request->input('data'))
            ->map(fn($order) => Order::create($order))
            ->all();

        return new OrderStoreResponse($orders);
    }

    /**
     * Назначение заказа курьеру.
     *
     * @param OrderAssignRequest $request запрос с ID курьера и заказа.
     * @return NotFoundResponse|OrderAssignResponse ответ с данными заказа или ошибка 404.
     */
    public function assign(OrderAssignRequest $request): NotFoundResponse | OrderAssignResponse
    {
        $courierId = $request->input('courier_id');
        $orderId = $request->input('order_id');
        
        $courier = Courier::find($courierId);
        if (!$courier) {
            return new NotFoundResponse("Курьер не найден.");
        }

        $order = Order::find($orderId);
        if (!$order) {
            return new NotFoundResponse("Заказ не найден.");
        }
        
        $order->courier_id = $courierId;
        $order->assign_time = Carbon::now();
        $order->save();
        
        return new OrderAssignResponse($order);
    }

    /**
     * Завершение заказа.
     *
     * @param OrderCompleteRequest $request запрос с ID курьера и заказа.
     * @return NotFoundResponse|NoContentResponse ответ 204 при успешном завершении или ошибка 404.
     */
    public function complete(OrderCompleteRequest $request): NotFoundResponse | NoContentResponse
    {
        $courierId = $request->input('courier_id');
        $orderId = $request->input('order_id');

        $courier = Courier::find($courierId);
        if (!$courier) {
            return new NotFoundResponse("Курьер не найден.");
        }

        $order = Order::where('id', $orderId)->where('courier_id', $courierId)->first();
        if (!$order) {
            return new NotFoundResponse("Заказ не найден или не принадлежит курьеру.");
        }

        $order->complete_time = Carbon::now();
        $order->save();

        return new NoContentResponse();
    }
}
