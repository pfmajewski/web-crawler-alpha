<?php

namespace App\Model;

/**
 * Class Option
 */
class Option
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
    static public function create(
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
}
