<?php

include_once 'search.php';
include_once 'sort.php';
include_once 'hotels.php';
include_once 'formValidation.php';


if (isset($_POST['submit'])) {
    $validatation = new FormValidation();
    $HotelData = new Hotels();
    $search = new Search();
    $hotels = $HotelData->getHotels();//  return array of hotels 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $validatation->addErrors(); // add arror if eny 
    }
    if ($validatation->enyError()) {
        // thess functions to fillter data
        
        // search with valide search 
        $hotels = $search->valideSearch($validatation,$hotels);
        
        header('Location: index.php?hotels='. urlencode(base64_encode(json_encode($hotels))));
    } else {
        if ($validatation->checkError())
            
        header('Location: index.php?error=enter valide search' );

    }

}


?>