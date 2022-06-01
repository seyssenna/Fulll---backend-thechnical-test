<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class VehicleAlreadyParkedException extends \Exception
{
    public function __construct()
    {
        return parent::__construct('A vehicle is already parked at this location.');
    }
}