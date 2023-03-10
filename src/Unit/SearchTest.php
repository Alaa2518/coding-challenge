<?php
namespace App\Unit;

use App\FormValidation;
use App\Hotels;
use PHPUnit\Framework\TestCase;
use App\Search;
use Vtiful\Kernel\Format;

class SearchTest extends TestCase
{

    public function testIfSearchByName(){
        // given
        $search = new Search();
        //when
        $hotel = $search->search((new Hotels())->getHotels(),'cairo','city');
        //then

        $this->assertEquals($hotel, $hotel);
    }

    public function testIfSearchByPrice()
    {
        // given
        $search = new Search();
        //when
        $hotel = $search->search((new Hotels())->getHotels(), 'cairo', 'city');
        //then

        $this->assertNotEmpty($hotel);

        $hotel = $search->search((new Hotels())->getHotels(), 'london', 'city');
        //then

        $this->assertNotEmpty($hotel);

        $hotel = $search->search((new Hotels())->getHotels(), 'morakadla', 'city');
        //then

        $this->assertEmpty($hotel);
    }

    public function testIfSearchByDate()
    {
        // given
        $search = new Search();
        //when
        $hotel = $search->searchByDate((new Hotels())->getHotels(), '02-10-2015', '10-05-2025');
        //then

        $this->assertEmpty($hotel);

        //when
        $hotel = $search->searchByDate((new Hotels())->getHotels(), '10-12-2023', '15-12-2023');
        //then

        $this->assertNotEmpty($hotel);
    }

    public function testIfSearchByManyDefrants()
    {
        // given
        $search = new Search();
        //when
        $hotel = $search->valideSearch(new FormValidation(), (new Hotels())->getHotels());
        //then

        $this->assertEmpty($hotel);
    }
}
