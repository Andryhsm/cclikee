<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\RegionRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
	protected $region_repository;

	public function __construct(RegionRepositoryInterface $region_repo)
	{
		$this->region_repository = $region_repo;
	}

	public function getState($country_id)
	{
		$states = $this->region_repository->getStateByCountry($country_id);
		return response()->json($states);
	}
}
