<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\LanguageInterface;
use App\Repositories\EmailTemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class EmailTemplateController extends Controller
{
    protected $email_template_repository;
	protected $language_repository;

    public function __construct(EmailTemplateRepository $email_template_repository, LanguageInterface $language)
    {
        $this->email_template_repository = $email_template_repository;
		$this->language_repository = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $email_templates = \Yajra\Datatables\Facades\Datatables::collection($this->email_template_repository->getAll())->make(true);
        $email_templates = $email_templates->getData();
        return view('admin.email_template.list', compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$languages = $this->language_repository->getOptions();
        return view('admin.email_template.form',compact('languages'));
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
            'template_name' => 'required',
            'en_subject' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $brand = $this->email_template_repository->create($request->all());
            if ($brand) {
                flash()->success(config('message.email-template.add-success'));
                return Redirect('admin/email-template');
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
    public function edit($id)
    {
		$languages = $this->language_repository->getOptions();
        $email_template = $this->email_template_repository->getById($id);
        return view('admin.email_template.edit', compact('email_template','languages'));
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
        //
        $rules = array(
            'template_name' => 'required',
            'en_subject' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $brand = $this->email_template_repository->updateById($id, $request->all());
            if ($brand) {
                flash()->success(config('message.email-template.update-success'));
                return Redirect('admin/email-template');
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
        if ($this->email_template_repository->deleteById($id)) {
            flash()->success(config('message.email-template.delete-success'));
        } else {
            flash()->error(config('message.email-template.delete-error'));
        }
        return Redirect::to('admin/email-template');

    }
}
