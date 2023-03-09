<?php

class Search{
	private $result ;

	function __construct(){
		$this->result =array() ;
	}
	public function search(array $hotels , string $valueToSearch, $key){ // search by name city 
		foreach ($hotels as $hotel ) {
			if (preg_match("/\b$valueToSearch\b/i", $hotel->$key)) {
				array_push($this->result, $hotel);
			}
		}
		return $this->result ;
	}


	public function searchByPrice(array $hotels,float $minPirce,float $maxPrice ){

		foreach ($hotels as $hotel) {
			if( (float)$hotel->price >=$minPirce && (float)$hotel->price <= $maxPrice){
				array_push($this->result, $hotel);
			}
		}
		return $this->result;
	}

	public function shearchByDate(array $hotels, $from, $to)
	{
		$format = "d-m-Y";
		$rangeDate = false ;
		foreach ($hotels as $hotel) {
			foreach($hotel->availability as $availabile){
				if (DateTime::createFromFormat($format,$availabile->from) >= DateTime::createFromFormat($format, $from) &&
						DateTime::createFromFormat($format,$availabile->to) <= DateTime::createFromFormat($format, $to) ){
						
						$rangeDate = true;
				}
			}
			if ($rangeDate){
				array_push($this->result,$hotel);
				$rangeDate = false;
			}
		}
		return $this->result;
	}


}



?>