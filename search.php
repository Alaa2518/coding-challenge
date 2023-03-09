<?php

// include_once 'main.php';

// include_once 'linearSearch.php';


// $HotelData = new HotelsData();

// $hotels = $HotelData->getAllHotelsData();
function cleanStr($string)
{
    
    // Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\s]/', ' ', $string);
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '-', $string);
    // delet spaces if eny . 
    $string = trim($string);

    return $string;
}

// chage date format 
function cleanDate($date)
{    
    return date("d-m-Y", strtotime($date));
}

// this fuinction match this $100:$500 input and  returen the max price and min price 
function cleanPrice($string)
{

    if (preg_match('/^\$[0-9]+:\$[0-9]+$/', $string)){
        // Removes special chars.
        $string = preg_replace('/[^0-9\s:]/','', $string);
        list($minPrice, $maxPrice) = explode(":", $string);
        if ((float) $maxPrice < (float) $minPrice){
            $price = array($maxPrice, $minPrice);
            return $price;
        }
        $price =array($minPrice,$maxPrice); 
        return $price;
    }
    return "not match";
    
}
// print_r($_POST['submit']);


?>

