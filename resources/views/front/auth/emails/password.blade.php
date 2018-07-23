@extends('global.email.email_template')
@section('main')
    <table width="100%" cellpadding="0" cellspacing="0" class="content_holder">
        <tr>
            <td class="content-block">
                Click <a href="{!! URL('forgot', $token) !!}">here</a> to reset your password.
            </td>
        </tr>
    </table>
@stop