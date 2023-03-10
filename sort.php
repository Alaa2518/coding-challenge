<?php 

include_once 'mergeSort.php';

// calss sort by name
class SortByName extends MergeSort{

    
    function __construct(array $hotels){
        $this->hotels = $hotels;
        $this->key ='name' ;
    }
    // main founction return the sorted arrey 
    public function sort(){ 
        $size = sizeof($this->hotels);
        $this->mergesort($this->hotels, 0, $size - 1);
        return $this->hotels;
    }
    
}
// calss sort by price 
class SortByPrice extends MergeSort
{
    
    function __construct(array $hotels)
    {
        $this->hotels = $hotels;
        $this->key = 'price';
    }
    // main founction return the sorted arrey 
    public function sort()
    {
        $size = sizeof($this->hotels);
        $this->mergesort($this->hotels, 0, $size - 1);
        return $this->hotels;
    }
}


?>

