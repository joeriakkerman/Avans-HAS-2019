<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/about.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript" src="{{ asset('js/about.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>

        <title>About us</title>
    </head>
    <body>
        <div id="mysidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="{{ url('/')}}"> Home</a>
            <a href="{{ url('/about')}}"> About</a>
        </div>
        <span class="navbtn" style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
        <div class="container">
            <div id="banner">
                <img src="{{ asset('img/about-banner2.jpg') }}" alt="den bosch bossen">
                <h1>About us!</h1>
            </div>
            <img id="main-image" src="{{ asset('img/shertogenbosch.png') }}">
            <span class="cardbtn" style="font-size:30px;cursor:pointer;"onclick="showCard()">&#9779;</span>
        </div>
        <div id="info-card" style=" visibility: hidden;">
            <div id="card" style=" visibility: hidden;">
                <span href="javascript:void(0)" style="font-size:30px; margin-left:96%;cursor:pointer;" onclick="hideCard()">&times;</span>
                <h1>Vincent - Van Gogh</h1>
                <p> Van Gogh werd geboren in het Brabantse Zundert, een dorpje vlak bij de Belgische grens, als zoon van de predikant Theodorus van Gogh (1822-1885)en Anna Cornelia Carbentus (1819-1907), dochter van een Haagse boekbinder. 
                    <br>Precies een jaar voor zijn geboorte hadden zij ook al een zoon gekregen die zij Vincent noemden, hoewel hij doodgeboren was. Na Vincent volgden nog drie zussen en twee broers: Anna, Theo, Wil, Lies en Cor. Theo werd vier jaar na Vincent geboren. Regelmatig wandelde het hele gezin in de omgeving van Zundert, waardoor de basis werd gelegd voor Vincents liefde voor de natuur. 
                    <br>
                    <br>Als kind was Vincent een zwijgzame, enigszins in zichzelf gekeerde jongen. Van januari tot oktober 1861 bezocht hij de dorpsschool, maar het jaar daarop werd hij alweer van school gehaald en kreeg hij thuisonderwijs. Volgens zijn ouders zou hij door de omgang met de dorpskinderen op de dorpsschool te onbehouwen worden. Binnen de beslotenheid van de pastorie kreeg hij de volgende drie jaar les van zijn vader en gouvernante Anna Birnie. Per 1 oktober 1864 ging Vincent naar de kostschool van meester Jan </p>
                <img id="card-img" src="{{ asset('img/info-painting.jpg') }}"> 
            </div>
        </div>

    </body>
</html>