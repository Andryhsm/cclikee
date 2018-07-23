@extends($layout)
@section('content')
    <section class="content-header">
        @include('notification')
        <h1>
            @if($media)
                Update Epartner Image
            @else
                Add Epartner Image
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' => ($media) ? url("admin/epartner/$media->id"):url('admin/epartner'),'files' => true,'id'=>'epartner_image_form','method'=>($media) ? 'PATCH' : 'post')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="page_title">Epartner Name</label>
                            <input type="text" name="name" class="form-control required" id="name" value="{!! ($media) ? $media->name: null !!}" placeholder="Epartner Name">
                        </div>
                        <div class="form-group">
                            <label for="content-heading">Epartner Image</label>
                            {!! Form::file('image',array('class'=>'form-control','id'=>'image')) !!}
                            @if($media && file_exists(public_path('upload/epartner/'.$media->image)))
                                {{ Form::image('upload/epartner/'.$media->image, null, ['class' => 'brand-image'])}}
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!!  url('/admin/epartner') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" id="add_image" class="btn btn-primary pull-right save-form">Save</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','#add_image', function () {
            $('#epartner_image_form').validate({
                errorPlacement: function (error, element) {
                    return error.insertAfter(element);
                }
            });
            if ($('#epartner_image_form').valid()) {
                $('#epartner_image_form').submit();
            }
        });
    })
</script>
@stop