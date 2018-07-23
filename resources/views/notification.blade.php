@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }} page-alert custom-notification">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php printf((Session::get('flash_notification.message'))) ?> </div>
@endif
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger display-hide page-alert custom-notification" style="display: block;">
        <button class="close" data-close="alert"></button>
        @foreach($errors->all() as $error)
            <p>{{$error}} </p>
        @endforeach
    </div>
@endif
<div class="alert ajax-request-alert  hidden">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span class="alert-message"></span>
</div>