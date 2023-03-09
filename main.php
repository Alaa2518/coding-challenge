<?php

// $api_url = 'https://api.npoint.io/dd85ed11b9d8646c5709';

// Print data if need to debug
// print_r($hotel_data);

// Traverse array and display hotel data
// foreach ($hotel_data as $hotel) {
// 	echo "name: " . $hotel->name;
// 	echo "<br />";
//     echo "price: " . $hotel->price;
//     echo "<br />";
//     echo "city: " . $hotel->city;
//     echo "<br />";
//     foreach($hotel->availability as $availability){
//         echo "from: " . $availability->from;
//         echo " :to: " . $availability->to ;
//         echo "<br/>";
//     }
// 	echo "<br /> <br />";
// }



class HotelsData{
    const API_URL = 'https://api.npoint.io/dd85ed11b9d8646c5709';
    private $json_data ;
    private $response_data;
    private $hotel_data;
    function __construct(){
        // Read JSON file
        $this->json_data = file_get_contents(self::API_URL);
        // Decode JSON data into PHP array
        $this->response_data = json_decode($this->json_data);
        // All hotels data exists in 'data' object
        $this->hotel_data = $this->response_data->hotels;
    }
    
    public function getAllHotelsData(){
        return $this->hotel_data;
    }

    public function getHotalName()
    {
        $names = array();

        // Traverse array and display hotel data
        foreach ($this->hotel_data as $hotel) {
            array_push($names,$hotel->name);
        }
        return $names;
    }

    public function getPrice()
    {
        $prices = array();

        // Traverse array and display hotel data
        foreach ($this->hotel_data as $hotel) {
            
            array_push($prices, $hotel->price);
        }
        return $prices;
    }

    public function getDestination()
    {
        $cities = array();

        // Traverse array and display hotel data
        foreach ($this->hotel_data as $hotel) {
            array_push($cities, $hotel->city);
        }
        return $cities;
    }

    
}



?>
