<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>


    <title>RoadLeaf</title>
</head>

{!! HTML::script('js/leaflet.js')!!}
{!! HTML::script('js/GeoJSONExample/Example1.js')!!}
{!! HTML::script('js/leaflet/leaflet-routing-machine.js')!!}

{!! HTML::style('css/leaflet/leaflet.css') !!}
{!! HTML::style('css/leaflet/leaflet-map.css') !!}
{!! HTML::style('css/leaflet/leaflet-routing-machine.css') !!}

<body>
    <div id="mysidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ url('/')}}"> Home</a>
        <a href="{{ url('/about')}}"> About</a>
        <a href="{{ url('/project')}}"> Project</a>
    </div>
    <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
    <div id="container">
        <img id="background-image" src="{{ asset('img/main.jpg') }}" alt="Bossen van Den Bosch">    

        <div id="banner">
            <p>Welkom bij<p>
            <h1>Natuurlijke Brabantse schoonheid</h1>
            <p>Scroll naar beneden om</p>
            <p>Brabant te beleven...</p>
        </div>
    </div>
    <div id="map-container">
        <div id="leaflet"></div>
        <div id="legenda">
            @foreach($categories as $category)
                <button type="button" onclick="changeToCategory( '{{$category->name}}' )">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>    
        <script type="text/javascript" src="{{ asset('js/leaflet_create.js') }}"></script>
    </div>
</body>
</html>
