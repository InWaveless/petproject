<?php
declare(strict_types=1);
namespace App\Model;

class Answer
{
    public int $id;

    public ?string $data;

    public function __construct(int $id, ?string $data)
    {
        $this->id = $id;
        $this->data = $data;
    }
}