<?php 

include_once 'mergeSort.php';
include_once 'main.php';

class SortByName extends MergeSort{

    
    function __construct(HotelsData $hotels){
        $this->hotels = $hotels->getAllHotelsData();
        $this->key ='name' ;
    }

    public function sort(){
        $size = sizeof($this->hotels);
        $this->mergesort($this->hotels, 0, $size - 1);
        return $this->hotels;
    }
    
}

class SortByPrice extends MergeSort
{
    
    function __construct(HotelsData $hotels)
    {
        $this->hotels = $hotels->getAllHotelsData();
        $this->key = 'price';
    }

    public function sort()
    {
        $size = sizeof($this->hotels);
        $this->mergesort($this->hotels, 0, $size - 1);
        return $this->hotels;
    }
}


?>

