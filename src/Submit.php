<?php

namespace App;

use App\FormValidation;

use App\Hotels;
use App\Search;
use App\SortByName;
use App\SortByPrice;


class Submit{
    public function submit(){
        if (isset($_POST['submit'])) {
            $validatation = new FormValidation();
            
            $search = new Search();
            $HotelData = new Hotels();
            $hotels = $HotelData->getHotels(); //  return array of hotels 

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validatation->addErrors(); // add arror if eny 
            }
            if ($validatation->enyError()) {
                // thess functions to fillter data

                // search with valide search 
                $hotels = $search->valideSearch($validatation, $hotels);

                if ($_POST['sort']==='sortByPrice'){
                    $sort = new SortByPrice($hotels); // sort by price 
                    $hotels = $sort->sort();
                }else if ($_POST['sort'] === 'sortByName'){
                    $sort = new SortByName($hotels); // sort by name 
                    $hotels = $sort->sort();
                }


                header('http://localhost/index.php?hotels=' . urlencode(base64_encode(json_encode($hotels))));
            } else {
                if ($validatation->checkError())

                    header('http://localhost/index.php?error=enter valide search');

            }

        }

    }
}


$submit = new Submit;
$submit->submit();



?>