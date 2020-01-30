<?php

namespace App\Service;

use App\Model\Option;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

/**
 * Class Crawler
 */
class Crawler
{
    /**
     * @param string $html
     *
     * @return array
     */
    public function parse(string $html): array
    {
        $options = [];

        $crawler = new DomCrawler($html);

        foreach ($crawler->filter('div > .package') as $packageElement) {

            $packageDom = new DomCrawler($packageElement);

            $option = new Option();
            $option->optionTitle = $this->stripTags(
                $packageDom->filter('div.header h3')->html('')
            );
            $option->description = $this->stripTags(
                $packageDom->filter('div.package-features .package-name')->html('')
            );
            $option->discount = $this->stripTags(
                $packageDom->filter('div.package-features .package-price p')->html('')
            );
            $option->price = $this->stripTags(
                $this->stripParagraphs(
                    $packageDom->filter('div.package-features .package-price')->html('')
                )
            );
            $option->yearlyCost = $this->extractYearlyCost($option->price);

            $options[] = $option;
        }

        return $options;
    }

    /**
     * @param string $html
     *
     * @return string
     */
    private function stripTags(string $html): string
    {
        return trim(preg_replace('/ {1,}/', ' ', strip_tags(preg_replace('/<br {0,}\/?>/i', ' ', $html))));
    }

    /**
     * @param string $html
     *
     * @return string
     */
    private function stripParagraphs(string $html): string
    {
        return preg_replace('/<p[^>]*>[^<]*<\/p>/i', ' ', $html);
    }

    /**
     * @param string $price
     *
     * @return int
     */
    private function extractYearlyCost(string $price): int
    {
        $cost = 0;

        $matches = [];
        if (preg_match('/£([0-9.]+)/', $price, $matches) > 0) {
            $cost = intval(bcmul($matches[1], '100', 0));
        }
        if (preg_match('/per month/i', $price)) {
            $cost *= 12;
        }

        return $cost;
    }
}
