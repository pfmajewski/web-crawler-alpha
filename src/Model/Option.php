<?php

namespace App\Model;

/**
 * Class Option
 */
class Option implements \JsonSerializable
{
    /**
     * @var string
     */
    public $optionTitle;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     *
     */
    public $price;

    /**
     * @var string
     */
    public $discount;

    /**
     * @var int
     */
    public $yearlyCost;

    /**
     * @param string $optionTitle
     * @param string $description
     * @param string $price
     * @param string $discount
     * @param int    $yearlyCost
     *
     * @return Option
     */
    public static function create(
        string $optionTitle,
        string $description,
        string $price,
        string $discount,
        int $yearlyCost
    ): Option
    {
        $option = new Option();
        $option->optionTitle = $optionTitle;
        $option->description = $description;
        $option->price = $price;
        $option->discount = $discount;
        $option->yearlyCost = $yearlyCost;

        return $option;
    }

    /**
     * Used as sorting callback function
     *
     * @param Option $a
     * @param Option $b
     *
     * @return int
     */
    public static function sortByYearlyCostDescending(Option $a, Option $b): int
    {
        if ($a->yearlyCost == $b->yearlyCost) {
            return 0;
        } elseif ($a->yearlyCost > $b->yearlyCost) {
            return -1;
        } else {
            return 1;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'option title' => $this->optionTitle,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
        ];
    }
}
