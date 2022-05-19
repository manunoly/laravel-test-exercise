<?php

namespace App\Models;

class DataInput
{

    /**
     * Generate Television data
     */
    public static function generateTelevisionData($extras = []): Television
    {
        $data = [
            'price' => 12,
            'type' => ElectronicItem::ELECTRONIC_ITEM_TELEVISION,
            'wired' => null

        ];
        return new Television($data, $extras);
    }

    /**
     * Generate Console data
     */
    public static function generateConsoleData($extras = []): Console
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_CONSOLE,
            'wired' => ''

        ];
        return new Console($data, $extras);
    }

    /**
     * Generate Microwave data
     */
    public static function generateMicrowaveData(): Microwave
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_MICROWAVE,
            'wired' => ''

        ];
        return new Microwave($data);
    }

    /**
     * Generate Controller data
     */
    public static function generateControllerData($wire = true): Controller
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_CONTROLLER,
            'wired' => $wire ? 'Wired' : 'Remote'

        ];
        return new Controller($data);
    }

    /**
     * Generate static data for scenarios
     */
    public static function generateData(): array
    {
        self::generateConsoleData();
        self::generateTelevisionData();
        self::generateMicrowaveData();
        self::generateControllerData();
        $data = [
            self::generateConsoleData(
                [self::generateControllerData(), self::generateControllerData(), self::generateControllerData(false), self::generateControllerData(false)]
            ),
            self::generateTelevisionData([self::generateControllerData(false), self::generateControllerData(false)]),
            self::generateTelevisionData([self::generateControllerData(false)]),
            self::generateMicrowaveData()
        ];
        return $data;
    }

    /**
     * Generate Scenario one
     */
    public static function generateDataScenarioOne(): array
    {
        $data = self::generateData();
        $sortData = new ElectronicItems($data);
        $finalData['items'] = $sortData->getSortedItems();
        $finalData['totalPrice'] = $sortData->getTotalPrice();
        return $finalData;
    }

    /**
     * Generate Scenario two
     */
    public static function generateDataScenarioTwo($type): array
    {
        $data = self::generateData();
        $sortData = new ElectronicItems($data);
        $filterDataByType = $sortData->getItemsByType($type);
        $sortData = new ElectronicItems([$filterDataByType]);
        $finalData['items'] = $sortData->getSortedItems();
        $finalData['totalPrice'] = $sortData->getTotalPrice();
        return $finalData;
    }
}
