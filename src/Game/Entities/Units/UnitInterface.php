<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Enums\EnumInterface;

/**
 * Interface UnitInterface
 * @package Game\Entities\Units
 */
interface UnitInterface
{
    /**
     * @return EnumInterface
     */
    public function getCommand(): EnumInterface;

    /**
     * @return int
     */
    public function getLife(): int;

    /**
     * @param int $life
     */
    public function addLife(int $life);

    /**
     * @return int
     */
    public function getDamage(): int;

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canAttack(UnitInterface $unit): bool;

    /**
     * @param UnitInterface $unit
     */
    public function attack(UnitInterface $unit);

    /**
     * @param EarthInterface $earth
     * @return bool
     */
    public function canAttachEarth(EarthInterface $earth): bool;

    /**
     * @param EarthInterface $earth
     */
    public function attachEarth(EarthInterface $earth);

    /**
     * @return bool
     */
    public function canMove(): bool;

    /**
     * @return EnumInterface
     */
    public function getRace(): EnumInterface;
}