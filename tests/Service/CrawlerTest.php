<?php

namespace App\Tests\Service;

use App\Model\Option;
use App\Service\Crawler;
use PHPUnit\Framework\TestCase;

class CrawlerTest extends TestCase
{
    /**
     * @return array
     */
    public function dataParse()
    {
        $data = [];

        $data['test-01'] = [
            '$inHtml' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'crawlertest-01.html'),
            '$expOptions' => [
                Option::create(
                    'Option 40 Mins',
                    'Up to 40 minutes talk time per month including 20 SMS (5p / minute and 4p / SMS thereafter)',
                    '£6.00 (inc. VAT) Per Month',
                    '',
                    7200
                ),
                Option::create(
                    'Option 160 Mins',
                    'Up to 160 minutes talk time per month including 35 SMS (5p / minute and 4p / SMS thereafter)',
                    '£10.00 (inc. VAT) Per Month',
                    '',
                    12000
                ),
                Option::create(
                    'Option 300 Mins',
                    '300 minutes talk time per month including 40 SMS (5p / minute and 4p / SMS thereafter)',
                    '£16.00 (inc. VAT) Per Month',
                    '',
                    19200
                ),
                Option::create(
                    'Option 480 Mins',
                    'Up to 480 minutes talk time per year including 240 SMS (5p / minute and 4p / SMS thereafter)',
                    '£66.00 (inc. VAT) Per Year',
                    'Save £5 on the monthly price',
                    6600
                ),
                Option::create(
                    'Option 2000 Mins',
                    'Up to 2000 minutes talk time per year including 420 SMS (5p / minute and 4p / SMS thereafter)',
                    '£108.00 (inc. VAT) Per Year',
                    'Save £12 on the monthly price',
                    10800
                ),
                Option::create(
                    'Option 3600 Mins',
                    'Up to 3600 minutes talk time per year including 480 SMS (5p / minute and 4p / SMS thereafter)',
                    '£174.00 (inc. VAT) Per Year',
                    'Save £18 on the monthly price',
                    17400
                ),
            ],
        ];


        return $data;
    }

    /**
     * @param string $inHtml
     * @param array  $expOptions
     * @dataProvider dataParse
     */
    public function testParse(string $inHtml, array $expOptions)
    {
        $crawler = new Crawler();

        $outOptions = $crawler->parse($inHtml);

        self::assertEquals($expOptions, $outOptions);
    }
}
