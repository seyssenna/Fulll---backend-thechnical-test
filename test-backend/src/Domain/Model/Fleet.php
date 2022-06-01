<?php
declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\VehicleAlreadyRegisteredException;

final class Fleet
{
    private $vehicles = [];

    public function registerVehicle(Vehicle $vehicle): self
    {
        if (\in_array($vehicle, $this->vehicles)) {
            throw new VehicleAlreadyRegisteredException();
        }
        $this->vehicles[] = $vehicle;

        return $this;
    }

    public function hasVehicle(Vehicle $vehicle): bool
    {
        return \in_array($vehicle, $this->vehicles);
    }
}