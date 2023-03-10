<?php

namespace App;
class MergeSort {

    protected $hotels; // associative array for hotels data 
    protected $key = 'name'; // key use in sort 
    
    // function for merge sort - splits the array 
    // and call merge function to sort and merge the array
    // mergesort is a recursive function
    protected function mergesort(&$Array, $left, $right)
    {
        if ($left < $right) {
            $mid = $left + (int) (($right - $left) / 2);
            $this->mergesort($Array, $left, $mid);
            $this->mergesort($Array, $mid + 1, $right);
            $this->merge($Array, $left, $mid, $right);
        }
    }

    // merge function performs sort and merge operations
// for mergesort function
    protected function merge(&$Array, $left, $mid, $right)
    {
        // Create two temporary array to hold split 
        // elements of main array 
        $n1 = $mid - $left + 1; //no of elements in LeftArray
        $n2 = $right - $mid; //no of elements in RightArray    
        $LeftArray = array_fill(0, $n1, 0);
        $RightArray = array_fill(0, $n2, 0);
        for ($i = 0; $i < $n1; $i++) {
            $LeftArray[$i] = $Array[$left + $i];
        }
        for ($i = 0; $i < $n2; $i++) {
            $RightArray[$i] = $Array[$mid + $i + 1];
        }
        // In below section x, y and z represents index number
        // of LeftArray, RightArray and Array respectively
        $x = 0;
        $y = 0;
        $z = $left;
        $key = $this->key;
        while ($x < $n1 && $y < $n2) {
            if ($LeftArray[$x]->$key < $RightArray[$y]->$key) {
                $Array[$z] = $LeftArray[$x];
                $x++;
            } else {
                $Array[$z] = $RightArray[$y];
                $y++;
            }
            $z++;
        }

        // Copying the remaining elements of LeftArray
        while ($x < $n1) {
            $Array[$z] = $LeftArray[$x];
            $x++;
            $z++;
        }

        // Copying the remaining elements of RightArray
        while ($y < $n2) {
            $Array[$z] = $RightArray[$y];
            $y++;
            $z++;
        }
    }

}
?>