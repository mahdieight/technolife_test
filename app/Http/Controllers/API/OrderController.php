<?php

namespace App\Http\Controllers\API;

use App\Contracts\Controller\API\OrderControllerInterface;
use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderIndexRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;


class OrderController extends Controller implements OrderControllerInterface
{
    public function index(OrderIndexRequest $request)
    {
        $status = $request->validated('status');
        $min_amount = $request->validated('min');
        $max_amount = $request->validated('max');
        $mobile_number = $request->validated('mobile_number');
        $national_code = $request->validated('national_code');

        $orders = Order::query()->statusFilter($status)
            ->when(($national_code || $mobile_number), function (Builder $query) use ($national_code, $mobile_number) {
                $query->whereHas('user', function (Builder $userQuery) use ($national_code, $mobile_number) {
                    $userQuery->likeFilter('national_code' , $national_code);
                    $userQuery->likeFilter('mobile_number' , $mobile_number);
                });
            })
            ->amountFilter(!is_null($min_amount), 'amount', $min_amount, '>=')
            ->amountFilter(!is_null($max_amount), "amount", $max_amount, "<=");


        return Response::message('order.messages.list_of_orders_has_been_received_successfully')->data(new OrderCollection($orders->paginate()))->status(201)->send();
    }
}
