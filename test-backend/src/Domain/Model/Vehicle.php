<?php
declare(strict_types=1);

namespace App\Domain\Model;

final class Vehicle
{
    private $location;
    private $fleet;

    public function __construct()
    {
    }

    public function parkAtLocation(Location $location) :self
    {
        $location->parkVehicle($this);
        $this->location = $location;
        return $this;
    }

    public function getFleet() : Fleet 
    {
        return $this->fleet;
    }

    public function verifyLocation(Location $location) : bool
    {
        return $this->location === $location;
    }
}