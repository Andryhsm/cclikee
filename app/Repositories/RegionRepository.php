<?php

namespace App\Repositories;


use App\Country;
use App\Interfaces\RegionRepositoryInterface;
use App\Region;

class RegionRepository implements RegionRepositoryInterface
{

	public function getCountries()
	{
		return Country::orderBy('name')->get();
	}

	public function getStateByCountry($country_id)
	{
		return Region::where('country_id', $country_id)->orderBy('name')->get();
	}

	public function getCityByState($state_id)
	{

	}
}