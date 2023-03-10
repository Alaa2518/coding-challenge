<?php
namespace App\Unit;

use App\Hotels;
use App\SortByName;
use PHPUnit\Framework\TestCase;


class SortByNameTest extends TestCase
{

    public function tesSortByName()
    {
        // given
        $hotelsnotsort = (new Hotels())->getHotels();
        //when
        $hotelsSorted = new SortByName($hotelsnotsort);
        //then

        $this->assertNotEquals($hotelsnotsort, $hotelsSorted->sort());
    }

}