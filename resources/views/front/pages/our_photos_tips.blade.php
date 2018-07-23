@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page">
        <div class="content-tips">
            <div class="title pb-30">
                <h2>NOS CONSEILS PHOTO</h2>
            </div>
            <h4 class="normal-title mt-20">Conseil 01</h4>
            <p>Veillez à photographier votre article à la <strong>lumière naturelle</strong>, sans flash,
            <strong>format portrait.</strong></p>
            <div class="row img-stips stips-1">
                <div class="col-mg-6 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_01_1.png' !!}"/>
                </div>
                <div class="col-mg-6 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_01_2.png' !!}"/>
                </div>
            </div>
            <h4 class="normal-title">Conseil 02</h4>
            <p>Pour les objets, privilégiez des <strong>supports neutres</strong>, tels que des tables ou
            des commodes non encombrées.<br>
            Pour les vêtements, nous conseillons de les prendre en photo <strong>sur cintre</strong>,
            de face et de dos.</p>
            <div class="row img-stips">
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_02_1.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_02_2.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_02_3.png' !!}"/>
                </div>
            </div>
            <h4 class="normal-title">Conseil 03</h4>
            <p>Prenez votre article en photo sur fond clair et neutre.</p>
            <div class="row img-stips">
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_03_1.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_03_2.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_03_3.png' !!}"/>
                </div>
            </div>
            <h4 class="normal-title">Conseil 04</h4>
            <p>Vos photographies doivent être <strong>nettes</strong>. Il est important qu’elles ne soient
            pas floues.<br>
            Petite astuce : optez pour la « <strong>haute résolution</strong> » sur votre appareil photo
            ou votre smartphone.</p>
            <div class="row img-stips stips-4">
                <div class="col-mg-6 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_04_1.png' !!}"/>
                </div>
                <div class="col-mg-6 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_04_2.png' !!}"/>
                </div>
            </div>
            <h4 class="normal-title">Conseil 05</h4>
            <p>Pour les vêtements, et accessoires de mode, prenez votre article <strong>sur
            mannequin</strong> (humain ou présentoir). Les acheteurs pourront plus
            facilement visualiser la coupe du produit.</p>
            <div class="row img-stips">
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_05_1.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_05_2.png' !!}"/>
                </div>
                <div class="col-mg-4 col-xs-12">
                    <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_05_3.png' !!}"/>
                </div>
            </div>
            <h4 class="normal-title">Conseil 06</h4>
            <p>N’hésitez pas à photographier votre article <strong>sous plusieurs plans</strong> (face,
            dos, gros plan sur les détails, étiquettes etc...)</p>
        </div>
        <div class="row img-stips mb-0">
            <div class="col-mg-3 col-xs-12">
                <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_06_1.png' !!}"/>
            </div>
            <div class="col-mg-3 col-xs-12">
                <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_06_2.png' !!}"/>
            </div>
            <div class="col-mg-3 col-xs-12">
                <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_06_3.png' !!}"/>
            </div>
            <div class="col-mg-3 col-xs-12">
                <img src="{!! URL::to('/').'/images/nos_conseils_photo/img_conseils_06_4.png' !!}"/>
            </div>
        </div>
    </div>
    @include('front.layout.section-avantage')
@endsection
@section('additional-css')
    <style type="text/css">
        .content-page p {
            margin: 0px;
        }
        @media(min-width: 781px)
        {
            .col-mg-3 {
                width: 25%;
                position: relative;
                min-height: 1px;
                padding: 1.5% 0.85%;
                float: left;
            }
            .col-mg-6 {
                width: 50%;
                position: relative;
                min-height: 1px;
                padding: 8px;
                float: left;
            }
            .col-mg-4 {
                width: 33.33333333%;
                position: relative;
                min-height: 1px;
                padding: 1.5% 0.85%;
                float: left;
            }
        }
        @media(max-width: 780px)
        {
            .img-stips > div {
                margin: 5% 0px;
            }
            .img-stips.stips-1, .img-stips.stips-4 {
                width: 100%;
            }
        }
    </style>
@endsection