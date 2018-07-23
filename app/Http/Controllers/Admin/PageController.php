<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\LanguageInterface;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class PageController extends Controller
{

    protected $page_repository;
	protected $language_repository;

    public function __construct(PageRepository $page_repository,LanguageInterface $language )
    {
        $this->page_repository = $page_repository;
		$this->language_repository = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Datatables::collection($this->page_repository->getAll())->make(true);
        $pages = $pages->getData();
        /*dd($pages);*/
        return view('admin.page.list', compact('pages'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$languages = $this->language_repository->getOptions();
        return view('admin.page.form',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = array(
            'fr_page_title' => 'required',
            'fr_content_heading' => 'required',
            'url_key' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $brand = $this->page_repository->create($request->all());
            if ($brand) {
                flash()->success(config('message.page.add-success'));
                return Redirect('admin/page');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page_id)
    {
        //
        $page = $this->page_repository->getById($page_id);
		$languages = $this->language_repository->getOptions();
		return view('admin.page.edit', compact('page','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'en_page_title' => 'required',
            'url_key' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $brand = $this->page_repository->updateById($id, $request->all());
            if ($brand) {
                flash()->success(config('message.page.update-success'));
                return Redirect('admin/page');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->page_repository->deleteById($id)) {
            flash()->success(config('message.page.delete-success'));
        } else {
            flash()->error(config('message.page.delete-error'));
        }
        return Redirect::to('admin/page');

    }
}
