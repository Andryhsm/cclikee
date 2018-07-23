@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page">
        <div class="title pb-30">
            <h2>PRESSE</h2>
        </div>
        <div class="presse-panel text-center">
            <img src="{!! URL::to('/').'/images/image_presse.png' !!}" alt="presse"/>
            <div class="text-content mt-40 mb-40">
                Vous souhaitez en savoir plus sur le concept, les valeurs et l’histoire de Clickee?<br>
                Vous pouvez nous écrire à <strong><a href="mailto:presse@clickee.fr">presse@clickee.fr</a></strong><br>
                Nous vous répondrons rapidement.
            </div>
            <a href="{!! route('contact-us-get') !!}" class="btn btn-filled mb-40" style="font-size:16px;">Nous contacter</a>
           
        </div>
    </div>
    @include('front.layout.section-avantage')
@endsection