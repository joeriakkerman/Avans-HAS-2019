<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RoadLeaf</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">

    {!! HTML::style('css/leaflet/leaflet.css') !!}
    {!! HTML::style('css/leaflet/leaflet-map.css') !!}
    {!! HTML::style('css/leaflet/leaflet-routing-machine.css') !!}

    {!! HTML::script('js/leaflet.js')!!}
    {!! HTML::script('js/leaflet/leaflet-routing-machine.js') !!}
</head>

<body>

<div id="leaflet" style="height: 80vh">
    <script type="text/javascript" src="{{ asset('js/leaflet_core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet_create.js') }}"></script>
</div>
<div id="points">
    @foreach($points as $l)
        <div class="point" style="width: 100px; margin: 20px; display: inline-block;">
            <label>
                <b>
                    <input type="text" name="project_id" value="{{$l->name}}" readonly>
                </b>
            </label>
            <label>
                <input type="text" name="latlng" value="{{$l->location}}" readonly>
            </label>
            <label>
                Neerzetten:
                <input type="checkbox" id="button-{{$l->id}}" name="placed" onclick="onCheckbox( '{{$l->location}}', '{{$l->id}}');">
            </label>
        </div>
    @endforeach
    <div id="travel-info" style="margin-left: 20px; margin-bottom: 5px;">
        <p>Totale km: 0</p>
        <p>Totale reistijd: 0:00</p>
    </div>
    <div id="options" style="margin: 20px;">
        <label>
            <b>Route naam:</b>
            <input id="routename" type="text" name="routename" value="Route naam">
        </label>

        <button style="background-color: gray; padding: 10px;" onclick="uploadRoute()">Upload route</button>

        <select id="selectedRoute">
            @foreach($routes as $route)
                <option value="{{ $route->id }}">{{ $route->name }}</option>
            @endforeach
        </select>

        <button style="background-color: gray; padding: 10px;" onclick="deleteRoute()">Verwijder route</button>
        <button style="background-color: gray; padding: 10px;" onclick="showRoute()">Laat route zien</button>
    </div>
</div>

</body>
</html>

