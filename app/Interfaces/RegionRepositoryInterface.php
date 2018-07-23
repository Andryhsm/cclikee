<?php

namespace App\Interfaces;


interface RegionRepositoryInterface
{

	public function getCountries();

	public function getStateByCountry($country_id);

	public function getCityByState($state_id);

}