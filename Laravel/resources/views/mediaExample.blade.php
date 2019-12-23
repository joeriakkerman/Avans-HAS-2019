<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/about.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript" src="{{ asset('js/about.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <title>Media Example</title>
    </head>
    <body>
        <div class="container">
            <form method="POST" action="/media" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Name"><br>
                <input type="hidden" name="folder" value="projects"><br>
                <input type="file" name="image"><br>
                <input type="submit" name="submit" value="Save">
            </form>

            @if(isset($media) && !empty($media))
                <img src="{{ route('media.get', ['name' => $media->name]) }}"/>
            @endif

            @if($errors->any())
                {{$errors->first()}}
            @endif
        </div>
    </body>
</html>