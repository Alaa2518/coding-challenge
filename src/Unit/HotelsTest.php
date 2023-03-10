<?php
namespace App\Unit;
use App\Hotels;
use PHPUnit\Framework\TestCase;


class HotelsTest extends TestCase{
    public function testIfRetrunData()
    {
        // given
        $HotelObj = new Hotels();
        //when
        $hotels = $HotelObj->getHotels();
        //then

        $this->assertNotEmpty($hotels);

        

        $hotels = $HotelObj->getHotelsName();
        //then

        $this->assertNotEmpty($hotels);

        $hotels = $HotelObj->getHotelsPrice();
        //then

        $this->assertNotEmpty($hotels);
    }
}