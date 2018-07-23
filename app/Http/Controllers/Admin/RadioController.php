<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RadioRepository;

class RadioController extends Controller
{
    protected $radio_repository;

	public function __construct(RadioRepository $radio_repository)
	{
		$this->radio_repository = $radio_repository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radios = \Datatables::collection($this->radio_repository->getAll())->make(true);
		$radios = $radios->getData();
		return view('admin.radio.index', compact('radios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $radio = false;
		return view('admin.radio.form', compact('radio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $radio = $this->radio_repository->create($request->all());
		flash()->success(config('message.radio.add-success'));
		return redirect()->route('radio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $radio = $this->radio_repository->getById($id);
		return view('admin.radio.form', compact('radio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $radio = $this->radio_repository->updateById($id, $request->all());
		flash()->success(config('message.radio.update-success'));
		return redirect()->route('radio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->radio_repository->deleteById($id);
		if ($status) {
			flash()->success(config('message.radio.delete-success'));
		} else {
			flash()->error(config('message.radio.delete-error'));
		}
		return redirect()->route('radio.index');
    }
}
