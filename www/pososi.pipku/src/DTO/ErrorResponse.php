<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

class ErrorResponse
{
    /**
     * @var int
     * @OA\Property()
     */
    public int $code;

    /**
     * @var string
     * @OA\Property()
     */
    public string $message;

    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->message
        ];
    }
}