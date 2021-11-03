<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

class BooleanResponse
{
    /**
     * @var bool
     * @OA\Property(description="boolean response")
     */
    public bool $result;
}