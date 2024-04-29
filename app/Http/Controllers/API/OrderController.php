<?php

namespace App\Http\Controllers\API;

use App\Contracts\Controller\API\OrderControllerInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderIndexRequest;

class OrderController extends Controller implements OrderControllerInterface
{
    public function index(OrderIndexRequest $request)
    {
    }
}
