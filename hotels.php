<?php


class Hotels{
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
    
    public function getHotels(){
        return $this->hotel_data;
    }

    public function getHotelsName()
    {
        $names = array();

        // Traverse array and display hotel data
        foreach ($this->hotel_data as $hotel) {
            array_push($names,$hotel->name);
        }
        return $names;
    }

    public function getHotelsPrice()
    {
        $prices = array();

        // Traverse array and display hotel data
        foreach ($this->hotel_data as $hotel) {
            
            array_push($prices, $hotel->price);
        }
        return $prices;
    }

    public function getHotelsCity()
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
