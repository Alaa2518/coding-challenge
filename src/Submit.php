<?php
namespace App;

use App\FormValidation;
use App\Hotels;
use App\Search;
use App\SortByName;
use App\SortByPrice;


class Submit{
    
    private $validatation;
    private $search ;
    private $HotelData;
    private $hotels ;
    function __construct(){
        $this->validatation = new FormValidation();
        $this->search = new Search();
        $this->HotelData = new Hotels();
        $this->hotels = $this->HotelData->getHotels();
    }
    public function submit(){
        

        if (isset($_POST['submit'])) {
             //  return array of hotels 

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->validatation->addErrors(); // add arror if eny 
            }
            if ($this->validatation->enyError()) {
                // thess functions to fillter data

                // search with valide search 
                $hotels = $this->search->valideSearch($this->validatation, $this->hotels);

                if ($_POST['sort']==='sortByPrice'){
                    $sort = new SortByPrice($hotels); // sort by price 
                    $hotels = $sort->sort();
                }else if ($_POST['sort'] === 'sortByName'){
                    $sort = new SortByName($hotels); // sort by name 
                    $hotels = $sort->sort();
                }

                return $hotels;
                // header('http://localhost/index.php?hotels=' . urlencode(base64_encode(json_encode($hotels))));
            } else {
                if ($this->validatation->checkError())
                    return false;
                    // header('http://localhost/index.php?error=enter valide search');

            }

        }

    }
}


// $submit = new Submit();
// $submit->submit();


