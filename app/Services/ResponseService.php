<?php

namespace App\Services;

use Illuminate\Support\Facades\Lang;

class ResponseService
{
    public int $status = 201;
    public string $message = 'success';
    public mixed $data = [];
    public array $errors = [];

    public function status(int $status): ResponseService
    {
        $this->status = $status;
        return $this;
    }


    public function message(string $message): ResponseService
    {
        $this->message = (Lang::has($message) ? __($message) : $message);
        return $this;
    }


    public function data($data): ResponseService
    {
        $this->data = $data;
        return $this;
    }

    public function errors($errors): ResponseService
    {
        $this->errors = is_array($errors) ? $errors : [$errors];
        return $this;
    }


    public function send()
    {
        return response([
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
        ], $this->status);
    }
}
