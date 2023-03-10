<?php
namespace App\Unit;

use App\Hotels;
use App\SortByPrice;
use PHPUnit\Framework\TestCase;


class SortByPriceTest extends TestCase
{

    public function tesSortByPrice()
    {
        // given
        $hotelsnotsort = (new Hotels())->getHotels();
        //when
        $hotelsSorted = new SortByPrice($hotelsnotsort);
        //then

        $this->assertNotEquals($hotelsnotsort, $hotelsSorted->sort());
    }
}