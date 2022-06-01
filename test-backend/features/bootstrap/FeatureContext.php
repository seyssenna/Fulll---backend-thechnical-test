<?php
declare(strict_types=1);

use App\Domain\Model\Fleet;
use App\Domain\Model\Vehicle;
use App\Domain\Model\Location;
use App\App\Command\RegisterVehicleCommand;
use App\Domain\Exception\VehicleAlreadyParkedException;
use App\Domain\Exception\VehicleAlreadyRegisteredException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    private $fleet;
    private $anotherFleet;
    private $vehicle;
    private $registerError = null;
    private $parkError = null;
    private $location;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given my fleet
     */
    public function myFleet()
    {
        $this->fleet = new Fleet();
    }

    /**
     * @Given a vehicle
     */
    public function aVehicle()
    {
        $this->vehicle = new Vehicle();
    }

    /**
     * @When I register this vehicle into my fleet
     * @Given I have registered this vehicle into my fleet
     * @When I try to register this vehicle into my fleet
     */
    public function iRegisterThisVehicleIntoMyFleet()
    {
        try {
            $this->fleet->registerVehicle($this->vehicle);
        } catch (VehicleAlreadyRegisteredException $th) {
            $this->registerError = $th;
        }
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        assert($this->fleet->hasVehicle($this->vehicle) === true, 'This vehicle is not part of this fleet.');
    }

    /**
     * @Then I should be informed this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
    {
        assert($this->registerError, 'This vehicle is not part of this fleet.');
    }

    /**
     * @Given the fleet of another user
     */
    public function theFleetOfAnotherUser()
    {
        $this->anotherFleet = new Fleet();
    }

    /**
     * @Given this vehicle has been registered into the other user's fleet
     */
    public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
    {
        try {
            // var_dump($this->anothertFleet);
            $this->anotherFleet->registerVehicle($this->vehicle);
        } catch (VehicleAlreadyRegisteredException $th) {
            $this->registerError = $th;
        }
    }

    /**
     * @Given a location
     */
    public function aLocation()
    {
        $this->location = new Location();
    }

    /**
     * @When I park my vehicle at this location
     * @Given my vehicle has been parked into this location
     * @When I try to park my vehicle at this location
     */
    public function iParkMyVehicleAtThisLocation()
    {
        try {
            $this->vehicle->parkAtLocation($this->location);
        } catch (VehicleAlreadyParkedException $th) {
            $this->parkError = $th;
        }  
    }

    /**
     * @Then the known location of my vehicle should verify this location
     */
    public function theKnownLocationOfMyVehicleShouldVerifyThisLocation()
    {
        assert($this->vehicle->verifyLocation($this->location) === true, 'This location is still available, the vehicle is not parked');
    }

    /**
     * @Then I should be informed that my vehicle is already parked at this location
     */
    public function iShouldBeInformedThatMyVehicleIsAlreadyParkedAtThisLocation()
    {
        
        assert($this->parkError !== null, 'This location is not available');
    }
    
}
