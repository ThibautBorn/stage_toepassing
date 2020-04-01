<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KU Leuven</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <meta name="description" content="KU Leuven OneButton">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
          href="//fonts.googleapis.com/css?family=Material+Icons|Open+Sans:400italic,600italic,700italic,400,700,600|Merriweather:400italic,400,700">
    <!-- bower:css-->
    <link rel="stylesheet" href="//stijl.kuleuven.be/2016/release/latest/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" title="default" media="screen, projection"/>
    <!-- endbower-->
    <link href="{{ asset('bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>


</head>
<body>
<div class="l-page">
    <!-- global header-->
@include('includes.header_nl_inc')

<div id="language" class="display-none">
    {{ Session::get('locale') }}
</div>
