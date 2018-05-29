<?php

namespace Game\Entities;


use Game\Entities\Earth\EarthInterface;

/**
 * Interface MapInterface
 * @package Game\Entities
 */
interface MapInterface
{
    /**
     * @param int $x
     * @param int $y
     * @param EarthInterface $earth
     */
    public function setEarth(int $x, int $y, EarthInterface $earth);

    /**
     * @param int $x
     * @param int $y
     * @return EarthInterface
     */
    public function getEarth(int $x, int $y): EarthInterface;

    /**
     * @return array
     */
    public function getAllEarth(): array;
}