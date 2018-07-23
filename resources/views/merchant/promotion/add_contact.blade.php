@extends('merchant.layout.master')

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}

    {!! Html::style('frontend/css/style-clickee.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/communication.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Communication</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
<section class="content">
    <div class="bottle">
        <section class="content-header text-center">
            <strong class="text-uppercase">
                Ajouter des contacts
            </strong>
        </section>
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class=""> <!-- box box-primary -->
                    
                    <div class="box-body">   
                        <form action="{!! url('/subscribe') !!}" method="post" class="" id="add_contact">
                            <input type="text" name="email" class="form-control required email" placeholder='email*'/>
                            <button style="margin:10px 0 0 40%;" type="submit" id="subscribe" class="col-lg-2 btn btn-merchant-filled">Ajouter</button>
                        </form>
                    </div>    
                    
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@section('additional-script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stop