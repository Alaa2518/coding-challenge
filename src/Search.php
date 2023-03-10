<?php

// include_once 'formValidation.php';


namespace App;


use App\FormValidation;

class Search{
	private $result ;

	function __construct(){
		$this->result =array() ;
	}

	// function search by name or By city 
	public function search(array $hotels , string $valueToSearch, $key){ 
		foreach ($hotels as $hotel ) {
			if (preg_match("/\b$valueToSearch\b/i", $hotel->$key)) {
				array_push($this->result, $hotel);
			}
		}
		return $this->result ;
	}


	// function search By price tack two values min Price and max Price 
	public function searchByPrice(array $hotels,float $minPirce,float $maxPrice ){

		foreach ($hotels as $hotel) {
			if( (float)$hotel->price >=$minPirce && (float)$hotel->price <= $maxPrice){
				array_push($this->result, $hotel);
			}
		}
		return $this->result; // return search arrey  with values 
	}
    
	// search By date Availbaile on the time from date user want to another date 
	public function searchByDate(array $hotels, $from, $to)
	{
		$format = "d-m-Y";
		$rangeDate = false ;
		foreach ($hotels as $hotel) {
			foreach($hotel->availability as $availabile){
				if (\DateTime::createFromFormat($format,$availabile->from) >= \DateTime::createFromFormat($format, $from) &&
						\DateTime::createFromFormat($format,$availabile->to) <= \DateTime::createFromFormat($format, $to) ){
						
						$rangeDate = true;
				}
			}
			if ($rangeDate){
				array_push($this->result,$hotel);
				$rangeDate = false;
			}
		}
		return $this->result;  // result array have the search reasult 
	}

	// this function choice all valide search the user used return all hotels on the search
	public function valideSearch(FormValidation $validatation,array $hotels){

		$Hotels = $hotels;

		$name = $validatation->cleanStr($_POST['name']);
		$price = $validatation->cleanPrice($_POST['price']);
		$dateFrom = $validatation->changeDateFormat($_POST['from']);
		$dateTo = $validatation->changeDateFormat($_POST['to']);
		$destination = $validatation->cleanStr($_POST['destination']);

		if ( ! in_array('name',$validatation->get_errors())){
			
			$Hotels = $this->search($Hotels,$name,'name');
		}if (!in_array('price', $validatation->get_errors()) ){
			
			$Hotels = $this->searchByPrice($Hotels,(float)$price[0], (float) $price[1]);

		}if(!in_array('date', $validatation->get_errors())){
			
			$Hotels = $this->searchByDate($Hotels,$dateFrom,$dateTo );

		}if(!in_array('destination', $validatation->get_errors())){
			
			$Hotels = $this->search($Hotels, $destination, 'city');
		}
		return $Hotels;

	}


}



?>