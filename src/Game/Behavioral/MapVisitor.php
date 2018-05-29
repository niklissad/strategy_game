<?php

namespace Game\Behavioral;

use Game\Creational\DtoFactory;
use Game\Dto\Block;
use Game\Entities\Earth\EarthInterface;
use Game\Entities\Earth\HillInterface;
use Game\Entities\Earth\LandInterface;
use Game\Entities\Earth\SwampInterface;
use Game\Entities\Earth\WaterInterface;
use Game\Entities\MapInterface;
use Game\Entities\Units\CommandCenterInterface;
use Game\Entities\Units\FighterInterface;
use Game\Entities\Units\SoldierInterface;
use Game\Entities\Units\TankInterface;
use Game\Entities\Units\UnitInterface;
use Game\Enums\EarthTypeEnum;
use Game\Enums\UnitTypeEnum;

/**
 * Class MapVisitor
 * @package Game\Behavioral
 */
class MapVisitor implements MapVisitorInterface
{
    /** @var MapInterface */
    private $map;
    /** @var DtoFactory */
    private $dtoFactory;

    /**
     * MapVisitor constructor.
     * @param DtoFactory $dtoFactory
     */
    public function __construct(DtoFactory $dtoFactory)
    {
        $this->dtoFactory = $dtoFactory;
    }

    /**
     * @param MapInterface $map
     */
    public function visitMap(MapInterface $map)
    {
        $this->map = $map;
    }

    /**
     * @return Block[]
     * @throws \Exception
     */
    public function getMapBlocksInformation(): array
    {
        if (!$this->map) {
            throw new \Exception('Attribute map is empty');
        }

        $items = [];
        foreach ($this->map->getAllEarth() as $x => $row) {
            /** @var EarthInterface $earth */
            foreach ($row as $y => $earth) {
                $block = $this->dtoFactory->createBlock();
                $block->x = $x;
                $block->y = $y;
                $block->earth = $this->getBlockType($earth);

                if ($earth->hasFlyUnit()) {
                    $block->flyUnit = $this->dtoFactory->createUnit();
                    $block->flyUnit->race = $earth->getFlyUnit()->getRace()->getValue();
                    $block->flyUnit->command = $earth->getFlyUnit()->getCommand()->getValue();
                    $block->flyUnit->life = $earth->getFlyUnit()->getLife();
                    $block->flyUnit->type = $this->getUnitType($earth->getFlyUnit());
                }

                if ($earth->hasEarthUnit()) {
                    $block->earthUnit = $this->dtoFactory->createUnit();
                    $block->earthUnit->race = $earth->getEarthUnit()->getRace()->getValue();
                    $block->earthUnit->command = $earth->getEarthUnit()->getCommand()->getValue();
                    $block->earthUnit->life = $earth->getEarthUnit()->getLife();
                    $block->earthUnit->type = $this->getUnitType($earth->getEarthUnit());
                }

                array_push($items, $block);
            }
        }

        return $items;
    }

    /**
     * @return bool
     */
    public function hasMovingUnits(): bool
    {
        foreach ($this->map->getAllEarth() as $x => $row) {
            /** @var EarthInterface $earth */
            foreach ($row as $y => $earth) {
                if ($earth->hasEarthUnit() && $earth->getEarthUnit()->canMove()) {
                    return true;
                } elseif ($earth->hasFlyUnit() && $earth->getFlyUnit()->canMove()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return CommandCenterInterface
     */
    public function getCommandCenter(): CommandCenterInterface
    {
        foreach ($this->map->getAllEarth() as $x => $row) {
            /** @var EarthInterface $earth */
            foreach ($row as $y => $earth) {
                if ($earth->hasEarthUnit() && $earth->getEarthUnit() instanceof CommandCenterInterface) {
                    return $earth->getEarthUnit();
                }
            }
        }
    }

    /**
     * @param EarthInterface $earth
     * @return string
     * @throws \Exception
     */
    private function getBlockType(EarthInterface $earth): string
    {
        if ($earth instanceof HillInterface) {
            return EarthTypeEnum::HILL;
        } elseif ($earth instanceof WaterInterface) {
            return EarthTypeEnum::WATER;
        } elseif ($earth instanceof SwampInterface) {
            return EarthTypeEnum::SWAMP;
        } elseif ($earth instanceof LandInterface) {
            return EarthTypeEnum::LAND;
        }

        throw new \Exception('Bad instance');
    }

    /**
     * @param UnitInterface $unit
     * @return string
     * @throws \Exception
     */
    private function getUnitType(UnitInterface $unit): string
    {
        if ($unit instanceof CommandCenterInterface) {
            return UnitTypeEnum::COMMAND_CENTER;
        } elseif ($unit instanceof FighterInterface) {
            return UnitTypeEnum::FIGHTER;
        } elseif ($unit instanceof SoldierInterface) {
            return UnitTypeEnum::SOLDIER;
        } elseif ($unit instanceof TankInterface) {
            return UnitTypeEnum::TANK;
        }

        throw new \Exception('Bad instance');
    }
}