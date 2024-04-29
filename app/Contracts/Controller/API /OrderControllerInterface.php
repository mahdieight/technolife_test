<?php

namespace App\Contracts\Controller\API;

use App\Http\Requests\OrderIndexRequest;

interface OrderControllerInterface
{
    public function index(OrderIndexRequest $request);
}
