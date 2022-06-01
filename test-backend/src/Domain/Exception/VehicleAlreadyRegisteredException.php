<?php

namespace App\Domain\Exception;

final class VehicleAlreadyRegisteredException extends \Exception
{

    public function __construct()
    {
        return parent::__construct('This vehicle has already been registered into my fleet.');
    }
}