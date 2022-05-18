<?php

namespace App\Models;

class DataInput
{

    public static function generateTelevisionData($extras = []): Television
    {
        $data = [
            'price' => 12,
            'type' => ElectronicItem::ELECTRONIC_ITEM_TELEVISION,
            'wired' => null

        ];
        return new Television($data, $extras);
    }

    public static function generateConsoleData($extras = []): Console
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_CONSOLE,
            'wired' => ''

        ];
        return new Console($data, $extras);
    }

    public static function generateMicrowaveData(): Microwave
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_MICROWAVE,
            'wired' => ''

        ];
        return new Microwave($data);
    }

    public static function generateControllerData($wire = true): Controller
    {
        $data = [
            'price' => 12.5,
            'type' => ElectronicItem::ELECTRONIC_ITEM_CONTROLLER,
            'wired' => $wire ? 'Wired' : 'Remote'

        ];
        return new Controller($data);
    }

    public static function generateDataScenarioOne()
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
        $sortData = new ElectronicItems($data);
        return $sortData->getSortedItems();
    }
}
