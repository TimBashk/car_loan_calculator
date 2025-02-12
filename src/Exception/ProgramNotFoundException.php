<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class ProgramNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("Program not found", Response::HTTP_NOT_FOUND, null);
    }
}