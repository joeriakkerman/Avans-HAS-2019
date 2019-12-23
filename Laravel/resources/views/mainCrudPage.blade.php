<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RoadLeaf</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">

    <link href='/Fonts/Market_Deco.css' rel='stylesheet' type='text/css'>
    <link href='/Fonts/FlorenceRegular.css' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="app">
    <v-app>
        <main-crud-page></main-crud-page>
    </v-app>
</div>
<script src="../js/app.js"></script>

</body>
</html>
