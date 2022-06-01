<?php
declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\VehicleAlreadyParkedException;

final class Location
{
    private $vehicle = null;

    public function __construct()
    {
    }

    public function parkVehicle(Vehicle $vehicle)
    {
        if ($this->vehicle !== null) {
            throw new VehicleAlreadyParkedException();
        }
        $this->vehicle = $vehicle;

        return $this;
    }
}