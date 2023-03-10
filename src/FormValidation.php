<?php

namespace App;
class FormValidation{

    private $error_fields = array();

    public function get_errors(){
        return $this->error_fields;
    }
    public function cleanStr($string)
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
    public function changeDateFormat($date)
    {
        return date("d-m-Y", strtotime($date));
    }

    // this fuinction match this $100:$500 input and  returen the max price and min price 
    public function cleanPrice($string)
    {

        if (preg_match('/^\$[0-9]+:\$[0-9]+$/', $string)) {
            // Removes special chars.
            $string = preg_replace('/[^0-9\s:]/', '', $string);
            list($minPrice, $maxPrice) = explode(":", $string);
            if ((float) $maxPrice < (float) $minPrice) {
                $price = array($maxPrice, $minPrice);
                return $price;
            }
            $price = array($minPrice, $maxPrice);
            return $price;
        }else  {
            array_push($this->error_fields, 'price');
        }

        return false ;
        
    }

    // this function add errors in the error_fields if eny 
    public function addErrors (){
        if (!(isset($_POST['name']) && !empty($_POST['name']))) {
            
            array_push($this->error_fields,'name');
        }
        if (!(isset($_POST['price']) && !empty(trim($_POST['price'])))) {
            
            array_push($this->error_fields, 'price');
        }
        if (!(isset($_POST['from']) && !empty($_POST['from']) && isset($_POST['to']) && !empty($_POST['to']))) {
            
            array_push($this->error_fields, 'date');
        }
        if (!(isset($_POST['destination']) && !empty($_POST['destination']))) {
            
            array_push($this->error_fields, 'destination');
        }
    } 

    // this funciton return true if don't have an error  
    public function enyError (){
        return (!in_array('name', $this->error_fields) ||
                !in_array('price', $this->error_fields) ||
                !in_array('date', $this->error_fields) ||
                !in_array('destination', $this->error_fields));
    }

    // this function retrun true if it have an error 
    public function checkError()
    {
        return (in_array('name', $this->error_fields) ||
                    in_array('price', $this->error_fields) ||
                    in_array('date', $this->error_fields) ||
                    in_array('destination', $this->error_fields)
                );
    }


}


?>

