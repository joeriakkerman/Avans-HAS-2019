<?php

use App\Models\Project;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;

class ProjectPointsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Using a Factory to seed data.
    // https://laravel.com/docs/5.8/database-testing#writing-factories

    $this->AddProjectPointFromJSON(
      51.53974257010371,
      5.503828525543213,
      'eten en drinken',
      "De Vresselse Hut",
      "Bij De Vresselse Hut kun je kegelen, maar ook diverse activiteiten, feesten, partijen en vergaderingen worden hier georganiseerd. Er is ook een terras waar je een drankje en een hapje van de kleine kaart kunt nuttigen.",
      '{
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "bezienswaardigheid_naam": "De Vresselse Hut",
              "beschrijving": "Bij De Vresselse Hut kun je kegelen,maar ook diverse activiteiten, feesten, partijen en vergaderingen worden hier georganiseerd. Er is ook een terras waar je een drankje en een hapje van de kleine kaart kunt nuttigen.",
              "frequentie": "altijd",
              "categorie": "Eten & Drinken",
              "stroke": ""
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                5.503828525543213,
                51.53974257010371
              ]
            }
          }'
    );
    $this->AddProjectPointFromJSON(
      51.5718,
      5.2389,
      'natuurgebied',
      "Oisterwijkse Bossen en Vennen",
      " ",
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
                  "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Oisterwijkse Bossen en Vennen",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
          [
              [
                5.2349768534745325,
                51.57824557639225
              ],
              [
                5.231558733647413,
                51.579098424176195
              ],
              [
                5.227251902665242,
                51.57814323465817
              ],
              [
                5.227422808656598,
                51.57686396298225
              ],
              [
                5.225030124777614,
                51.57621579866645
              ],
              [
                5.221236011769512,
                51.576011115198305
              ],
              [
                5.217305173968325,
                51.577290386874225
              ],
              [
                5.213887054141205,
                51.57526060914843
              ],
              [
                5.212485625012087,
                51.57398133747251
              ],
              [
                5.211802001046662,
                51.57195155974672
              ],
              [
                5.209580223159035,
                51.5709963702287
              ],
              [
                5.207187539280051,
                51.56939301639488
              ],
              [
                5.203564332263304,
                51.56854016861094
              ],
              [
                5.202026178341101,
                51.5697000415971
              ],
              [
                5.197377535376218,
                51.56842076992118
              ],
              [
                5.193788509557743,
                51.56726089693501
              ],
              [
                5.192079449644183,
                51.56598162525909
              ],
              [
                5.190165302540996,
                51.56415653100145
              ],
              [
                5.189481678575572,
                51.562024411541586
              ],
              [
                5.190165302540996,
                51.560745139865666
              ],
              [
                5.1903703897306235,
                51.558613020405794
              ],
              [
                5.192592167618251,
                51.558613020405794
              ],
              [
                5.194472133523167,
                51.5569073248379
              ],
              [
                5.195155757488591,
                51.55392235759409
              ],
              [
                5.197377535376218,
                51.552950111120396
              ],
              [
                5.203222520280592,
                51.5518925798683
              ],
              [
                5.206503915314627,
                51.552421345494345
              ],
              [
                5.212485625012087,
                51.55317185154422
              ],
              [
                5.215596114054765,
                51.55434878148606
              ],
              [
                5.21833060991646,
                51.5562591605221
              ],
              [
                5.221782910941851,
                51.555303971004086
              ],
              [
                5.225201030768971,
                51.55412704106224
              ],
              [
                5.230362391707921,
                51.55487754711211
              ],
              [
                5.2354895714486,
                51.55562805316198
              ],
              [
                5.234293229509108,
                51.55648090094593
              ],
              [
                5.230875109681989,
                51.556685584414076
              ],
              [
                5.229507861751141,
                51.55839127998197
              ],
              [
                5.226568278699818,
                51.55967055165789
              ],
              [
                5.225201030768971,
                51.561495645915535
              ],
              [
                5.227593714647954,
                51.56181972807344
              ],
              [
                5.2322423576128365,
                51.562126753275656
              ],
              [
                5.234805947483176,
                51.56287725932553
              ],
              [
                5.236685913388092,
                51.564054189267374
              ],
              [
                5.238600060491279,
                51.56533346094329
              ],
              [
                5.241847274327042,
                51.56523111920922
              ],
              [
                5.242530898292466,
                51.56480469531725
              ],
              [
                5.245812293326501,
                51.56490703705132
              ],
              [
                5.248717695179552,
                51.56608396699317
              ],
              [
                5.248204977205484,
                51.56789200429513
              ],
              [
                5.252853620170367,
                51.56939301639488
              ],
              [
                5.253024526161723,
                51.57258266710684
              ],
              [
                5.255759022023418,
                51.57386193878276
              ],
              [
                5.267414810633896,
                51.57270206579659
              ],
              [
                5.277737532511797,
                51.57398133747251
              ],
              [
                5.282351994278407,
                51.57578937477448
              ],
              [
                5.283035618243831,
                51.57824557639225
              ],
              [
                5.282864712252476,
                51.58070177801001
              ],
              [
                5.280301122382136,
                51.582288074888154
              ],
              [
                5.277053908546372,
                51.58358440351975
              ],
              [
                5.274285231486406,
                51.58431785261394
              ],
              [
                5.2741143254950495,
                51.58529009908764
              ],
              [
                5.275139761443185,
                51.58656937076356
              ],
              [
                5.27496885545183,
                51.58805332590763
              ],
              [
                5.254904492066638,
                51.586995794655536
              ],
              [
                5.251281285049892,
                51.58559712428986
              ],
              [
                5.249914037119044,
                51.58677405423171
              ],
              [
                5.2480340712141285,
                51.58571652297962
              ],
              [
                5.24235999230111,
                51.5844372513037
              ],
              [
                5.2428727102751775,
                51.58315797962778
              ],
              [
                5.239112778465347,
                51.58058237932026
              ],
              [
                5.2349768534745325,
                51.57824557639225
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.49947637969359,
      5.43411523103714,
      'activiteit',
      'Familiepark DippieDoe',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Familiepark DippieDoe",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Activiteit",
          "stroke-opacity": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.43411523103714,
            51.49947637969359
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50365386157651,
      5.310038924217224,
      'activiteit',
      'Oirschotse stoel Jan Appels',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Oirschotse stoel Jan Appels",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.310038924217224,
            51.50365386157651
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5414,
      5.3589,
      'natuurgebied',
      'De Mortelen',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "De Mortelen",
          "frequentie": "altijd",
          "categorie": "Natuurgebied"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.3852032198764315,
                51.52978676530841
              ],
              [
                5.383118166781888,
                51.53405100422814
              ],
              [
                5.387083185781346,
                51.53459682680987
              ],
              [
                5.390843117591178,
                51.53672894626973
              ],
              [
                5.395320854564704,
                51.5382129014138
              ],
              [
                5.396175384521484,
                51.539816255247615
              ],
              [
                5.3922103655220255,
                51.541965431663165
              ],
              [
                5.389304963668974,
                51.54377346896513
              ],
              [
                5.38431450872138,
                51.54600793015907
              ],
              [
                5.380896388894261,
                51.5455815062671
              ],
              [
                5.374709592007174,
                51.546980176632765
              ],
              [
                5.364421051327545,
                51.55081799166052
              ],
              [
                5.361857461457205,
                51.54996514387658
              ],
              [
                5.357550630475035,
                51.55028922603448
              ],
              [
                5.355841570561475,
                51.55284776938632
              ],
              [
                5.3527310815187965,
                51.553700617170264
              ],
              [
                5.342442540839167,
                51.556685584414076
              ],
              [
                5.339537138986115,
                51.556054477053955
              ],
              [
                5.336768461926149,
                51.55487754711211
              ],
              [
                5.335059402012589,
                51.55347887674644
              ],
              [
                5.334033966064453,
                51.55167083944447
              ],
              [
                5.329727135082282,
                51.55146615597633
              ],
              [
                5.3293853230995705,
                51.55039156776855
              ],
              [
                5.332324906150894,
                51.54846413177683
              ],
              [
                5.333692154081741,
                51.546980176632765
              ],
              [
                5.335913931969369,
                51.54633201231697
              ],
              [
                5.335230308003945,
                51.54430223459117
              ],
              [
                5.329727135082282,
                51.544523975015004
              ],
              [
                5.325967203272452,
                51.5435517285413
              ],
              [
                5.321831278281637,
                51.54184603297341
              ],
              [
                5.31619138056689,
                51.54184603297341
              ],
              [
                5.31533685061011,
                51.54302296291525
              ],
              [
                5.313251797515567,
                51.544421633280926
              ],
              [
                5.312568173550143,
                51.546434354051044
              ],
              [
                5.3108591136365835,
                51.546980176632765
              ],
              [
                5.309150053723024,
                51.54783302441671
              ],
              [
                5.307270087818108,
                51.54783302441671
              ],
              [
                5.305185034723565,
                51.54911229609263
              ],
              [
                5.303475974810006,
                51.551039732084355
              ],
              [
                5.300399666965598,
                51.55081799166052
              ],
              [
                5.300399666965598,
                51.54943637825053
              ],
              [
                5.299545137008818,
                51.546980176632765
              ],
              [
                5.299545137008818,
                51.544523975015004
              ],
              [
                5.29988694899153,
                51.54227245686538
              ],
              [
                5.3029632568359375,
                51.54227245686538
              ],
              [
                5.306381376663057,
                51.543244703339084
              ],
              [
                5.307953711783532,
                51.54227245686538
              ],
              [
                5.307270087818108,
                51.54003799567144
              ],
              [
                5.309150053723024,
                51.53961157177947
              ],
              [
                5.312909985532855,
                51.539713913513545
              ],
              [
                5.314995038627398,
                51.53938983135564
              ],
              [
                5.319096782419941,
                51.539816255247615
              ],
              [
                5.31619138056689,
                51.53811055967972
              ],
              [
                5.317558628497737,
                51.53705302842763
              ],
              [
                5.321831278281637,
                51.53544967459381
              ],
              [
                5.324599955341603,
                51.53459682680987
              ],
              [
                5.329727135082282,
                51.53459682680987
              ],
              [
                5.333521248090385,
                51.535654358061954
              ],
              [
                5.3381698910552675,
                51.5374794523196
              ],
              [
                5.341588010882387,
                51.537360053629854
              ],
              [
                5.343467976787303,
                51.536626604535655
              ],
              [
                5.346749371821337,
                51.53640486411183
              ],
              [
                5.348800243717609,
                51.5374794523196
              ],
              [
                5.351363833587949,
                51.5368312880038
              ],
              [
                5.354132510647916,
                51.53597844021986
              ],
              [
                5.355670664570119,
                51.534903852012086
              ],
              [
                5.359088784397239,
                51.534272744651965
              ],
              [
                5.361857461457205,
                51.53577375675171
              ],
              [
                5.3657882992583925,
                51.53544967459381
              ],
              [
                5.36715554718924,
                51.53341989686802
              ],
              [
                5.370095130240563,
                51.53341989686802
              ],
              [
                5.373000532093615,
                51.53394866249406
              ],
              [
                5.375222309981242,
                51.532993472976045
              ],
              [
                5.374709592007174,
                51.53106603698433
              ],
              [
                5.376247745929378,
                51.528183411474586
              ],
              [
                5.379700046954769,
                51.52850749363249
              ],
              [
                5.3852032198764315,
                51.52978676530841
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.618827585051214,
      5.43486088514328,
      'eten en drinken',
      'De Glazen Boerderij',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "De Glazen Boerderij",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.43486088514328,
            51.618827585051214
          ]
        }
      }'
      
    );
    $this->AddProjectPointFromJSON(
      51.59444853503294,
      5.233080983161926,
      'eten en drinken',
      'Pannekoekenhuis Belveren in Haaren',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Pannekoekenhuis Belveren in Haaren",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.233080983161926,
            51.59444853503294
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50537683608064,
      5.357208251953125,
      'activiteit',
      'De wijk Heikandt in Aarle',
      'Wandeling in het kader van 200 jaar Best.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "beschrijving": "Wandeling in het kader van 200 jaar Best.",
          "bezienswaardigheid_naam": "De wijk Heikandt in Aarle",
          "stroke-opacity": "",
          "frequentie": "Zaterdag 13 april",
          "gebied_naam": "",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.357208251953125,
            51.50537683608064
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.49944632447973,
      5.364031791687012,
      'activiteit',
      'Lentefeest bij Buurtvrij',
      'Vandaag vieren we de lente!  Dit doen we met veel bloemen, hutten bouwen, interieur styling, workshops, graffiti, BBQ en nog veel meer.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Lentefeest bij Buurtvrij",
          "beschrijving": "Vandaag vieren we de lente!  Dit doen we met veel bloemen, hutten bouwen, interieur styling, workshops, graffiti, BBQ en nog veel meer.",
          "marker-color": "#7e7e7e",
          "frequentie": "Zondag 14 april ",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.364031791687012,
            51.49944632447973
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.516728140021236,
      5.353946685791016,
      'activiteit',
      'Workshop paasstuk maken',
      'Op zaterdag 13 april a.s. organiseert Team De vlinder in samenwerking met Winterfestijn Best een workshop Paasstukjes maken voor het goede doel. De workshop vindt plaats in de werkplaats van Ad Raaijmakers Akkerbouw en Gewasverzorging in Best. Onder het genot van een kopje koffie of thee en wat lekkers wordt gewerkt aan de mooiste paasstukken.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Workshop paasstuk maken",
          "beschrijving": "Op zaterdag 13 april a.s. organiseert Team De vlinder in samenwerking met Winterfestijn Best een workshop Paasstukjes maken voor het goede doel. De workshop vindt plaats in de werkplaats van Ad Raaijmakers Akkerbouw en Gewasverzorging in Best. Onder het genot van een kopje koffie of thee en wat lekkers wordt gewerkt aan de mooiste paasstukken. ",
          "frequentie": "Zaterdag 13 april",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.353946685791016,
            51.516728140021236
          ]
          }
        }'
    );
    $this->AddProjectPointFromJSON(
      51.55690237162714,
      5.2020263671875,
      'bezienswaardigheid',
      'Kolkven',
      'Maak een leuke korte wandeling door het Oisterwijkse bos langs enkele vennen, waaronder het Kolkven.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Kolkven",
          "beschrijving": "Maak een leuke korte wandeling door het Oisterwijkse bos langs enkele vennen, waaronder het Kolkven.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.2020263671875,
            51.55690237162714
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5863548288564,
      5.177282989025116,
      'bezienswaardigheid',
      'Kerkhovense Molen',
      'De Kerkhovense Molen of Onvermoeid is een ronde stenen stellingmolen te Oisterwijk.',
      '{
        "type": "Feature",
        "properties": {
          "frequentie": "altijd",
          "bezienswaardigheid_naam": "Kerkhovense Molen",
          "beschrijving": "De Kerkhovense Molen of Onvermoeid is een ronde stenen stellingmolen te Oisterwijk.",
          "categorie": "Bezienswaardigheid",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.177282989025116,
            51.5863548288564
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.589297858596424,
      5.231863260269165,
      'bezienswaardigheid',
      'Kasteel Nemerlaer',
      'Kasteel Nemerlaer is een 14e-eeuws kasteel, gelegen in Haaren, in de Nederlandse provincie Noord-Brabant',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Kasteel Nemerlaer",
          "beschrijving": "Kasteel Nemerlaer is een 14e-eeuws kasteel, gelegen in Haaren, in de Nederlandse provincie Noord-Brabant",
          "categorie": "Bezienswaardigheid ",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.231863260269165,
            51.589297858596424
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.465130385364795,
      5.266613960266113,
      'bezienswaardigheid',
      'Oude Toren',
      'De Oude Toren is een middeleeuwse kerktoren bij Oostelbeers in de gemeente Oirschot in de Nederlandse provincie Noord-Brabant.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "beschrijving": "De Oude Toren is een middeleeuwse kerktoren bij Oostelbeers in de gemeente Oirschot in de Nederlandse provincie Noord-Brabant.",
          "bezienswaardigheid_naam": "Oude Toren",
          "categorie": "Bezienwaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.266613960266113,
            51.465130385364795
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.543132343985604,
      5.130336284637451,
      'eten en drinken',
      'Abdij Koningshoeven',
      'Het ligt vlakbij het Landschapspark Moerenburg waar je heerlijk kunt wandelen. Daarnaast zijn er fietsroutes beschikbaar die je vanaf het trappistenklooster door karakteristieke dorpjes als Oisterwijk en Oirschot leiden. Ideale sportlocatie. Binnen de muren van klooster Abdij Koningshoeven brouwen de Benedictijner monniken het ambachtelijke trappistenbier La Trappe.',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Abdij Koningshoeven",
          "beschrijving": "Het ligt vlakbij het Landschapspark Moerenburg waar je heerlijk kunt wandelen. Daarnaast zijn er fietsroutes beschikbaar die je vanaf het trappistenklooster door karakteristieke dorpjes als Oisterwijk en Oirschot leiden. Ideale sportlocatie. Binnen de muren van klooster Abdij Koningshoeven brouwen de Benedictijner monniken het ambachtelijke trappistenbier La Trappe.",
          "stroke": "",
          "stroke-width": "",
          "stroke-opacity": "",
          "fill": "",
          "fill-opacity": "",
          "gebied_naam": "",
          "frequentie": "altijd",
          "categorie": "Museum / Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.130336284637451,
            51.543132343985604
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.60757003871097,
      5.1901817321777335,
      'bezienswaardigheid',
      'Vogelkijkscherm Leemputten',
      'Hier huist een aalscholverkolonie',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Vogelkijkscherm Leemputten",
          "frequentie": "altijd",
          "categorie": "Bezienswaardigheid",
          "beschrijving": "Hier huist een aalscholverkolonie"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.1901817321777335,
            51.60757003871097
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.570881622953564,
      5.397806167602539,
      'bezienswaardigheid',
      'Uitkijktoren t Meulke',
      'De beemden aan de beek zijn als vanouds in gebruik als weiland.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Uitkijktoren t Meulke",
          "beschrijving": "De beemden aan de beek zijn als vanouds in gebruik als weiland.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.397806167602539,
            51.570881622953564
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50356036497247,
      5.262365341186523,
      'bezienswaardigheid',
      'Vogelkijkscherm Kattenbergs Broek',
      'In 2007 en 2008 bracht Waterschap de Dommel hier iets groots tot stand. Over een lengte van 2 km werd de Beerze in zijn oorspronkelijke staat hersteld. Op basis van de topografische kaart van 1900 werden de bochten terug in de beek gebracht.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Vogelkijkscherm Kattenbergs Broek",
          "beschrijving": "In 2007 en 2008 bracht Waterschap de Dommel hier iets groots tot stand. Over een lengte van 2 km werd de Beerze in zijn oorspronkelijke staat hersteld. Op basis van de topografische kaart van 1900 werden de bochten terug in de beek gebracht.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.262365341186523,
            51.50356036497247
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.446143972759494,
      5.23747444152832,
      'bezienswaardigheid',
      'Observatiepost Landschotse Heide',
      'De venwitsnuitlibel: alleen al om die naam zou je dit gebied willen bezoeken. En dan vliegen er ook nog eens 28 andere soorten libellen rond boven de vennen.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Observatiepost Landschotse Heide",
          "beschrijving": "De venwitsnuitlibel: alleen al om die naam zou je dit gebied willen bezoeken. En dan vliegen er ook nog eens 28 andere soorten libellen rond boven de vennen.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "stroke": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.23747444152832,
            51.446143972759494
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.47218810785753,
      5.107269287109375,
      'bezienswaardigheid',
      'Vogelkijkscherm Rovertsche Heide',
      'Hier vliegt de vlinder het groentje en kruipen levendbarende hagedissen. Allemaal dankzij het open kappen van dit gebied.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Vogelkijkscherm Rovertsche Heide",
          "beschrijving": "Hier vliegt de vlinder het groentje en kruipen levendbarende hagedissen. Allemaal dankzij het open kappen van dit gebied.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.107269287109375,
            51.47218810785753
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.655931556048905,
      5.44147253036499,
      'bezienswaardigheid',
      'Kasteel Heeswijk',
      'Het weerspiegelt bijna duizend jaar macht, trots en cultuur van de Brabantse elite.',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "",
          "bezienswaardigheid_naam": "Kasteel Heeswijk",
          "beschrijving": "Het weerspiegelt bijna duizend jaar macht, trots en cultuur van de Brabantse elite.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "di/wo/do/zo",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.44147253036499,
            51.655931556048905
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.48974747380967,
      5.022704601287842,
      'bezienswaardigheid',
      'Ooijevaarsnest',
      'De naam moet oud zijn, want ooievaars zitten hier al sinds mensenheugenis niet meer. Door het terrein te vernatten doen we overigens hard ons best hem te verleiden tot terugkeer. Ooievaars eten immers graag kikkers.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Ooijevaarsnest",
          "beschrijving": "De naam moet oud zijn, want ooievaars zitten hier al sinds mensenheugenis niet meer. Door het terrein te vernatten doen we overigens hard ons best hem te verleiden tot terugkeer. Ooievaars eten immers graag kikkers.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "stroke": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.022704601287842,
            51.48974747380967
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.55380714718306,
      5.263395309448242,
      'bezienswaardigheid',
      'Graf van Tienhoven',
      'Aan de rand van het natuurgebied de Kampina bij Oisterwijk liggen enkele grote zwerfkeien waarin de jaren 1875 en 1953 gebeiteld staan. Het zijn de levensjaren van Pieter van Tienhoven, die bij testament had bepaald dat de urn met zijn as hier op de heide begraven moest worden.',
      '{
        "type": "Feature",
        "properties": {
          "beschrijving": "Aan de rand van het natuurgebied de Kampina bij Oisterwijk liggen enkele grote zwerfkeien waarin de jaren 1875 en 1953 gebeiteld staan. Het zijn de levensjaren van Pieter van Tienhoven, die bij testament had bepaald dat de urn met zijn as hier op de heide begraven moest worden.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Graf van Tienhoven"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.263395309448242,
            51.55380714718306
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.57201524785938,
      5.364128351211548,
      'eten en drinken',
      'Hap en Trap-arrangement',
      'Fiets door Het Groene Woud en proef de lokale specialiteiten. Je wordt verwelkomt in het hart van Liempde. Je krijgt een mooie fietsroute door Het Groene Woud, afgewisseld met zes stops op verrassende locaties. Geniet van de mooie natuur en proef de lokale specialiteiten. Laat je verrassen door de heerlijke streekproducten!',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Hap&Trap-arrangement",
          "beschrijving": "Fiets door Het Groene Woud en proef de lokale specialiteiten. Je wordt verwelkomt in het hart van Liempde. Je krijgt een mooie fietsroute door Het Groene Woud, afgewisseld met zes stops op verrassende locaties. Geniet van de mooie natuur en proef de lokale specialiteiten. Laat je verrassen door de heerlijke streekproducten!",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.364128351211548,
            51.57201524785938
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.52030989086833,
      5.266404747962952,
      'eten en drinken',
      'Spoordonkse watermolen',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Spoordonkse watermolen",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.266404747962952,
            51.52030989086833
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50266545920017,
      5.264575481414795,
      'bezienswaardigheid',
      'Kapel Heilige Eik',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Kapel Heilige eik",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Bezienswaardigheid"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.264575481414795,
            51.50266545920017
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.63971135519905,
      5.148293673992156,
      'eten en drinken',
      'De Rustende Jager',
      'Gelegen aan de rand van de Loonse en Drunense Duinen, met een groot terras en voldoende gelegenheid om binnen te zitten. Uitgebreide lunchkaart. Historisch aanlegpunt voor een wandeling, of tijdens een ritje met de fiets of te paard. Voor vergaderingen is een aparte zaal beschikbaar. Tevens een zeer ruim assortiment aan fietsverhuur, dagelijks beschikbaar.',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "De Rustende Jager",
          "beschrijving": "Gelegen aan de rand van de Loonse en Drunense Duinen, met een groot terras en voldoende gelegenheid om binnen te zitten. Uitgebreide lunchkaart. Historisch aanlegpunt voor een wandeling, of tijdens een ritje met de fiets of te paard. Voor vergaderingen is een aparte zaal beschikbaar. Tevens een zeer ruim assortiment aan fietsverhuur, dagelijks beschikbaar.",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken",
          "stroke-opacity": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.148293673992156,
            51.63971135519905
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.57653279570173,
      5.3791192173957825,
      'bezienswaardigheid',
      'Sint Janspontje',
      'Een pontje midden in een natuurgebied met houtwallen, hooilanden, weilanden, bos, heideveldjes en poelen.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Sint Janspontje",
          "beschrijving": "Een pontje midden in een natuurgebied met houtwallen, hooilanden, weilanden, bos, heideveldjes en poelen.",
          "frequentie": "altijd",
          "categorie": "Bezienswaardigheid"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.3791192173957825,
            51.57653279570173
          ]
        }
      }'
    );

    $this->AddProjectPointFromJSON(
      51.6969,
      5.1814,
      'natuurgebied',
      'Oostelijke Langstaat',
      '  ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#555555",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#555555",
          "gebied_naam": "Oostelijke Langstaat",
          "fill-opacity": 0.5,
          "bezienswaardigheid_naam": "",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "LineString",
          "coordinates": [
            [
              5.098354603984569,
              51.69639910838019
            ],
            [
              5.103481783725248,
              51.695546260596245
            ],
            [
              5.10898495664691,
              51.69384056502835
            ],
            [
              5.113120881637724,
              51.69256129335243
            ],
            [
              5.124093046282778,
              51.69341414113638
            ],
            [
              5.131988903083424,
              51.69320945766823
            ],
            [
              5.141935631780341,
              51.695546260596245
            ],
            [
              5.150173300563699,
              51.69639910838019
            ],
            [
              5.155676473485361,
              51.69853122784006
            ],
            [
              5.163914142268719,
              51.698735911308205
            ],
            [
              5.1721518110520766,
              51.69767838005611
            ],
            [
              5.181414915783571,
              51.696825532272165
            ],
            [
              5.188627148618792,
              51.695546260596245
            ],
            [
              5.196181193436726,
              51.694266988920326
            ],
            [
              5.207871163245475,
              51.69384056502835
            ],
            [
              5.218501515907817,
              51.69213486946046
            ],
            [
              5.226397372708462,
              51.69256129335243
            ],
            [
              5.236685913388092,
              51.695546260596245
            ],
            [
              5.247692259231417,
              51.69725195616414
            ]
          ]
        }
      }'

    );
    $this->AddProjectPointFromJSON(
      51.5589,
      5.2755,
      'natuurgebied',
      'Kampina',
      '  ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Kampina",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.294383776069868,
                51.57440776136448
              ],
              [
                5.273943419503693,
                51.56917127597105
              ],
              [
                5.275481573425897,
                51.56736323866909
              ],
              [
                5.277224814537728,
                51.56598162525909
              ],
              [
                5.2765411905723045,
                51.563303683217505
              ],
              [
                5.274456137477761,
                51.56137624722578
              ],
              [
                5.271208923641998,
                51.55999463381579
              ],
              [
                5.267072998651184,
                51.55967055165789
              ],
              [
                5.263996690806776,
                51.56064279813159
              ],
              [
                5.261262194945081,
                51.56106922202356
              ],
              [
                5.257468081936978,
                51.55956820992382
              ],
              [
                5.254220868101214,
                51.558613020405794
              ],
              [
                5.249572225136332,
                51.55711200830605
              ],
              [
                5.246837729274636,
                51.55583273663013
              ],
              [
                5.238258248508567,
                51.554979888846184
              ],
              [
                5.237916436525855,
                51.55274542765225
              ],
              [
                5.239454590448059,
                51.55049390950263
              ],
              [
                5.243385428249246,
                51.548788213934735
              ],
              [
                5.2452995753524325,
                51.54730425879067
              ],
              [
                5.2480340712141285,
                51.549538719984604
              ],
              [
                5.249743131127688,
                51.55177318117855
              ],
              [
                5.253366338144435,
                51.55337653501237
              ],
              [
                5.254904492066638,
                51.55583273663013
              ],
              [
                5.258151705902402,
                51.55573039489606
              ],
              [
                5.259006235859181,
                51.55199492160237
              ],
              [
                5.2586644238764695,
                51.549862802142506
              ],
              [
                5.259689859824605,
                51.54718486010091
              ],
              [
                5.261262194945081,
                51.545155082375125
              ],
              [
                5.264851220763556,
                51.5435517285413
              ],
              [
                5.268816239763014,
                51.54409755112303
              ],
              [
                5.272747077564202,
                51.54547916453302
              ],
              [
                5.27756662652044,
                51.54527448106487
              ],
              [
                5.278250250485864,
                51.54793536615079
              ],
              [
                5.276370284580948,
                51.55061330819238
              ],
              [
                5.273601607520981,
                51.55146615597633
              ],
              [
                5.273430701529626,
                51.55327419327829
              ],
              [
                5.277053908546372,
                51.55593507836421
              ],
              [
                5.281668370312984,
                51.556583242680006
              ],
              [
                5.286317013277866,
                51.5582889382479
              ],
              [
                5.292845622147664,
                51.55978995034764
              ],
              [
                5.294212870078511,
                51.56181972807344
              ],
              [
                5.297630989905631,
                51.56309899974936
              ],
              [
                5.297630989905631,
                51.56608396699317
              ],
              [
                5.3002287609742424,
                51.56736323866909
              ],
              [
                5.3017669148964455,
                51.568216086453035
              ],
              [
                5.301254196922378,
                51.57077462980487
              ],
              [
                5.298485519862411,
                51.57215624321487
              ],
              [
                5.297289177922919,
                51.57451010309856
              ],
              [
                5.296092835983427,
                51.57536295088251
              ],
              [
                5.294383776069868,
                51.57440776136448
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.4720,
      5.3188,
      'natuurgebied',
      'Oirschotsche Heide',
      '  ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Oirschotsche Heide",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.364246368408203,
                51.46630674826172
              ],
              [
                5.367336273193359,
                51.46577204161349
              ],
              [
                5.368537902832031,
                51.46684144864417
              ],
              [
                5.369052886962891,
                51.4688732529542
              ],
              [
                5.367851257324219,
                51.470798036736966
              ],
              [
                5.362529754638672,
                51.47197425351888
              ],
              [
                5.356349945068359,
                51.47218810785753
              ],
              [
                5.36407470703125,
                51.479779287414
              ],
              [
                5.366649627685547,
                51.48052764515145
              ],
              [
                5.372142791748047,
                51.47924473865486
              ],
              [
                5.376091003417969,
                51.47785488256033
              ],
              [
                5.381927490234375,
                51.48213122752529
              ],
              [
                5.3796958923339835,
                51.48320025111633
              ],
              [
                5.37677764892578,
                51.4830933498849
              ],
              [
                5.372314453125,
                51.484803739516046
              ],
              [
                5.374546051025391,
                51.48630027781863
              ],
              [
                5.371971130371094,
                51.4873692036782
              ],
              [
                5.367679595947266,
                51.48918632012956
              ],
              [
                5.363216400146484,
                51.49078959803455
              ],
              [
                5.357208251953125,
                51.491751537714705
              ],
              [
                5.350170135498047,
                51.491751537714705
              ],
              [
                5.343647003173827,
                51.4918584186485
              ],
              [
                5.339698791503906,
                51.49164465653034
              ],
              [
                5.337295532226562,
                51.493568479510415
              ],
              [
                5.335063934326172,
                51.49549222130398
              ],
              [
                5.33111572265625,
                51.49538534888975
              ],
              [
                5.326995849609375,
                51.49431661096613
              ],
              [
                5.323219299316406,
                51.49698840879303
              ],
              [
                5.321502685546875,
                51.49527847622497
              ],
              [
                5.3228759765625,
                51.49143089340988
              ],
              [
                5.325279235839844,
                51.49143089340988
              ],
              [
                5.327510833740234,
                51.49025517833077
              ],
              [
                5.331630706787109,
                51.488865657782796
              ],
              [
                5.332489013671875,
                51.48715542051101
              ],
              [
                5.3338623046875,
                51.48801054716568
              ],
              [
                5.333347320556641,
                51.48918632012956
              ],
              [
                5.336265563964844,
                51.49068271459497
              ],
              [
                5.337638854980469,
                51.48875876983271
              ],
              [
                5.339698791503906,
                51.489293207077296
              ],
              [
                5.339870452880859,
                51.487262312219904
              ],
              [
                5.334720611572266,
                51.48630027781863
              ],
              [
                5.336265563964844,
                51.48458994432048
              ],
              [
                5.332832336425781,
                51.48394855271953
              ],
              [
                5.330944061279297,
                51.48426924964768
              ],
              [
                5.328540802001952,
                51.489293207077296
              ],
              [
                5.325965881347656,
                51.48811743686986
              ],
              [
                5.325279235839844,
                51.48501753370923
              ],
              [
                5.323905944824219,
                51.48448304634681
              ],
              [
                5.321502685546875,
                51.48790365721089
              ],
              [
                5.318412780761719,
                51.489293207077296
              ],
              [
                5.311546325683594,
                51.4901482936383
              ],
              [
                5.305538177490234,
                51.49068271459497
              ],
              [
                5.303134918212891,
                51.4873692036782
              ],
              [
                5.3015899658203125,
                51.48512443042995
              ],
              [
                5.302448272705078,
                51.4830933498849
              ],
              [
                5.3002166748046875,
                51.48394855271953
              ],
              [
                5.295581817626953,
                51.48074145939243
              ],
              [
                5.291118621826172,
                51.48223813101211
              ],
              [
                5.284767150878906,
                51.48063455239723
              ],
              [
                5.280475616455078,
                51.47828253510031
              ],
              [
                5.291633605957031,
                51.469407923261336
              ],
              [
                5.290431976318359,
                51.4684455121972
              ],
              [
                5.2892303466796875,
                51.466734509068935
              ],
              [
                5.285968780517578,
                51.4655581571998
              ],
              [
                5.284938812255859,
                51.467055327042736
              ],
              [
                5.282707214355469,
                51.46694838796876
              ],
              [
                5.2809906005859375,
                51.46534427178355
              ],
              [
                5.279102325439453,
                51.46341925792338
              ],
              [
                5.27618408203125,
                51.46299146603759
              ],
              [
                5.275154113769531,
                51.461066352925236
              ],
              [
                5.272235870361328,
                51.460424630508356
              ],
              [
                5.2734375,
                51.45668106990573
              ],
              [
                5.274982452392578,
                51.45539749273061
              ],
              [
                5.277729034423828,
                51.45486265825492
              ],
              [
                5.282192230224609,
                51.45507659279715
              ],
              [
                5.289745330810547,
                51.46010376591622
              ],
              [
                5.291290283203125,
                51.45903420098401
              ],
              [
                5.285282135009766,
                51.45454175456166
              ],
              [
                5.294036865234375,
                51.45539749273061
              ],
              [
                5.2974700927734375,
                51.453792970504495
              ],
              [
                5.298671722412109,
                51.456146250469146
              ],
              [
                5.303134918212891,
                51.4581785309918
              ],
              [
                5.306739807128906,
                51.45914115860514
              ],
              [
                5.311031341552734,
                51.45999681055089
              ],
              [
                5.316009521484375,
                51.461280258392385
              ],
              [
                5.323734283447266,
                51.46245672054102
              ],
              [
                5.327339172363281,
                51.46406093823295
              ],
              [
                5.3318023681640625,
                51.463312310327886
              ],
              [
                5.334205627441406,
                51.46341925792338
              ],
              [
                5.332660675048828,
                51.46566509953196
              ],
              [
                5.335578918457031,
                51.46791083061189
              ],
              [
                5.3448486328125,
                51.4688732529542
              ],
              [
                5.353260040283203,
                51.46898018751687
              ],
              [
                5.358409881591797,
                51.470156451165124
              ],
              [
                5.36407470703125,
                51.469300989701175
              ],
              [
                5.364418029785156,
                51.467590018653155
              ],
              [
                5.364246368408203,
                51.46630674826172
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.7198,
      5.4142,
      'natuurgebied',
      'Karregat & Nulandse Heide',
      ' ',
      ' {
        "type": "Feature",
        "properties": {
          "categorie": "Natuurgebied",
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Karregat & Nulandse Heide",
          "bezienswaardigheid_naam": "",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.419521331787109,
                51.725539532689176
              ],
              [
                5.412998199462891,
                51.72639018118215
              ],
              [
                5.408191680908203,
                51.72543320050211
              ],
              [
                5.40802001953125,
                51.7225621369129
              ],
              [
                5.404930114746094,
                51.72086067986095
              ],
              [
                5.404586791992187,
                51.71788297595214
              ],
              [
                5.406646728515625,
                51.71607498862437
              ],
              [
                5.4073333740234375,
                51.713416052417614
              ],
              [
                5.423984527587891,
                51.71692581519461
              ],
              [
                5.422782897949219,
                51.71937185241758
              ],
              [
                5.4265594482421875,
                51.72075433666929
              ],
              [
                5.428791046142578,
                51.721605075199555
              ],
              [
                5.427932739257812,
                51.72415719474947
              ],
              [
                5.424842834472656,
                51.72543320050211
              ],
              [
                5.419521331787109,
                51.725539532689176
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.6554,
      5.3209,
      'natuurgebied',
      'Landgoed Haanwijk',
      '  ',
      ' {
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Landgoed Haanwijk",
          "bezienswaardigheid_naam": "",
          "categorie": "Natuurgebied",
          "marker-size": "",
          "marker-color": "",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.326352119445801,
                51.65647734325447
              ],
              [
                5.322275161743164,
                51.65623773016871
              ],
              [
                5.318498611450195,
                51.65743578292896
              ],
              [
                5.3168249130249015,
                51.65480002505009
              ],
              [
                5.316567420959473,
                51.65370840366704
              ],
              [
                5.322833061218262,
                51.65400128027731
              ],
              [
                5.323090553283691,
                51.6542941549951
              ],
              [
                5.326695442199707,
                51.654107780393645
              ],
              [
                5.326352119445801,
                51.65647734325447
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.6190,
      5.3126,
      'natuurgebied',
      'Landgoed Eikenhorst',
      '   ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Landgoed Eikenhorst",
          "beschrijving": "",
          "categorie": "Natuurgebied",
          "frequentie": "altijd",
          "marker-color": ""
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.314893722534179,
                51.6217468625888
              ],
              [
                5.31163215637207,
                51.62142713341988
              ],
              [
                5.3090572357177725,
                51.62132055652962
              ],
              [
                5.308971405029297,
                51.61982845378264
              ],
              [
                5.308027267456055,
                51.619135675115515
              ],
              [
                5.30940055847168,
                51.61833630197319
              ],
              [
                5.309915542602539,
                51.617110569140635
              ],
              [
                5.308542251586913,
                51.615991392859335
              ],
              [
                5.308370590209961,
                51.61508537279872
              ],
              [
                5.311031341552734,
                51.61572491824838
              ],
              [
                5.314121246337891,
                51.61673751344668
              ],
              [
                5.316610336303711,
                51.61695068850444
              ],
              [
                5.314893722534179,
                51.6217468625888
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5376,
      5.1442,
      'natuurgebied',
      'Kerkeindse Heide',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Kerkeindse Heide",
          "bezienswaardigheid_naam": "",
          "categorie": "Natuurgebied",
          "frequentie": "altijd",
          "marker-color": ""
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.14735221862793,
                51.53512459785485
              ],
              [
                5.151300430297852,
                51.53715336013257
              ],
              [
                5.1531028747558585,
                51.53763384321693
              ],
              [
                5.155849456787109,
                51.53859479416859
              ],
              [
                5.157480239868164,
                51.53806093503363
              ],
              [
                5.159626007080078,
                51.53806093503363
              ],
              [
                5.160484313964844,
                51.538915106643756
              ],
              [
                5.162115097045898,
                51.53880833606918
              ],
              [
                5.167350769042969,
                51.53907526203596
              ],
              [
                5.15533447265625,
                51.54355938420332
              ],
              [
                5.154476165771484,
                51.543185724231996
              ],
              [
                5.151300430297852,
                51.54339924459133
              ],
              [
                5.148725509643554,
                51.54371952325175
              ],
              [
                5.148210525512695,
                51.54436007380985
              ],
              [
                5.15009880065918,
                51.54564114787502
              ],
              [
                5.147953033447266,
                51.54617491809048
              ],
              [
                5.142374038696289,
                51.54564114787502
              ],
              [
                5.141000747680664,
                51.544626967214434
              ],
              [
                5.140571594238281,
                51.5410504655338
              ],
              [
                5.132589340209961,
                51.534216964401864
              ],
              [
                5.133876800537109,
                51.53293556871631
              ],
              [
                5.130529403686523,
                51.53026587851656
              ],
              [
                5.137052536010741,
                51.52668824818813
              ],
              [
                5.142030715942383,
                51.528770783618015
              ],
              [
                5.143318176269531,
                51.52796981972546
              ],
              [
                5.148038864135742,
                51.528610591966775
              ],
              [
                5.14735221862793,
                51.53512459785485
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5544,
      5.1546,
      'natuurgebied',
      'Galgeven',
      '  ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Galgeven",
          "bezienswaardigheid_naam": "",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.154819488525391,
                51.55295325509707
              ],
              [
                5.1560640335083,
                51.5530866767921
              ],
              [
                5.156922340393066,
                51.553593675664274
              ],
              [
                5.157909393310547,
                51.554047301444164
              ],
              [
                5.158038139343262,
                51.554474239222195
              ],
              [
                5.157265663146973,
                51.555408151641096
              ],
              [
                5.156707763671875,
                51.555674980238805
              ],
              [
                5.156192779541016,
                51.55591512463841
              ],
              [
                5.156106948852539,
                51.556181950262044
              ],
              [
                5.155806541442871,
                51.5563687272672
              ],
              [
                5.154776573181152,
                51.55626199764387
              ],
              [
                5.1546478271484375,
                51.55607522020041
              ],
              [
                5.154304504394531,
                51.55607522020041
              ],
              [
                5.154175758361816,
                51.55575502851286
              ],
              [
                5.153703689575195,
                51.55572834577052
              ],
              [
                5.153188705444336,
                51.55572834577052
              ],
              [
                5.1531028747558585,
                51.5555415661356
              ],
              [
                5.153017044067383,
                51.55530141976372
              ],
              [
                5.152673721313477,
                51.555087955257605
              ],
              [
                5.1519012451171875,
                51.55490117299298
              ],
              [
                5.151300430297852,
                51.55476775662006
              ],
              [
                5.1505279541015625,
                51.55463433985583
              ],
              [
                5.14984130859375,
                51.55410066888559
              ],
              [
                5.149111747741699,
                51.553727095480895
              ],
              [
                5.148768424987792,
                51.55380714718306
              ],
              [
                5.148811340332031,
                51.5533001506902
              ],
              [
                5.1491546630859375,
                51.55314004536056
              ],
              [
                5.14984130859375,
                51.55287320189221
              ],
              [
                5.151171684265136,
                51.55287320189221
              ],
              [
                5.152244567871094,
                51.55276646406656
              ],
              [
                5.153317451477051,
                51.5530866767921
              ],
              [
                5.154819488525391,
                51.55295325509707
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5577,
      5.1670,
      'natuurgebied',
      'Oude Hondsberg',
      '  ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Oude Hondsberg",
          "bezienswaardigheid_naam": "",
          "beschrijving": "",
          "categorie": "Natuurgebied",
          "frequentie": "altijd",
          "marker-color": "",
          "marker-size": "",
          "marker-symbol": ""
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.15932559967041,
                51.55476775662006
              ],
              [
                5.159883499145508,
                51.55458097304057
              ],
              [
                5.160784721374512,
                51.55474107329852
              ],
              [
                5.161471366882324,
                51.555168004564784
              ],
              [
                5.162801742553711,
                51.55527473675523
              ],
              [
                5.164089202880859,
                51.55506127212389
              ],
              [
                5.165977478027344,
                51.5551946876359
              ],
              [
                5.168423652648926,
                51.555514883267996
              ],
              [
                5.170869827270508,
                51.55578171123959
              ],
              [
                5.173616409301757,
                51.55535478573369
              ],
              [
                5.174474716186523,
                51.555034588974564
              ],
              [
                5.175461769104004,
                51.5549278562206
              ],
              [
                5.176234245300293,
                51.55532810275652
              ],
              [
                5.176277160644531,
                51.55604853764589
              ],
              [
                5.175890922546387,
                51.5564754566401
              ],
              [
                5.17430305480957,
                51.55690237162714
              ],
              [
                5.17331600189209,
                51.558529948254396
              ],
              [
                5.172028541564941,
                51.559944024922224
              ],
              [
                5.1694536209106445,
                51.56058434706352
              ],
              [
                5.166964530944824,
                51.56047762733274
              ],
              [
                5.164647102355957,
                51.5602375070228
              ],
              [
                5.162458419799805,
                51.5602375070228
              ],
              [
                5.161128044128418,
                51.56021082691011
              ],
              [
                5.160698890686035,
                51.560104106302795
              ],
              [
                5.160012245178223,
                51.55999738544502
              ],
              [
                5.15958309173584,
                51.55999738544502
              ],
              [
                5.158982276916503,
                51.559970705191446
              ],
              [
                5.158510208129882,
                51.559570499509555
              ],
              [
                5.158724784851074,
                51.559143609567016
              ],
              [
                5.15958309173584,
                51.55898352480549
              ],
              [
                5.160484313964844,
                51.55791627866145
              ],
              [
                5.160098075866699,
                51.55684900747291
              ],
              [
                5.160613059997559,
                51.55583507664607
              ],
              [
                5.1601409912109375,
                51.55580839395066
              ],
              [
                5.159540176391602,
                51.55548820038476
              ],
              [
                5.158510208129882,
                51.55506127212389
              ],
              [
                5.158724784851074,
                51.55460765645603
              ],
              [
                5.15932559967041,
                51.55476775662006
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.4879,
      5.0752,
      'natuurgebied',
      'Gorp de Leij',
      'Gorp de Leij is een gebiedje aan de hevig kronkelende Rovertsche Leij. Aan het beekje liggen 10 intieme bosweitjes. Aan de beek kan een blauwe flits u verrassen',
      ' {
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Gorp de Leij",
          "categorie": "Natuurgebied",
          "frequentie": "altijd",
          "marker-color": "",
          "marker-size": "",
          "marker-symbol": "",
          "beschrijving": "Gorp de Leij is een gebiedje aan de hevig kronkelende Rovertsche Leij. Aan het beekje liggen 10 intieme bosweitjes. Aan de beek kan een blauwe flits u verrassen"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.07568359375,
                51.49955318737237
              ],
              [
                5.062980651855468,
                51.492499698989036
              ],
              [
                5.067100524902344,
                51.48897254548231
              ],
              [
                5.06744384765625,
                51.487262312219904
              ],
              [
                5.063323974609375,
                51.48704852855153
              ],
              [
                5.062465667724609,
                51.48822432632349
              ],
              [
                5.061607360839844,
                51.48918632012956
              ],
              [
                5.059719085693359,
                51.49025517833077
              ],
              [
                5.0592041015625,
                51.48854499318077
              ],
              [
                5.059375762939453,
                51.486834743880806
              ],
              [
                5.053195953369141,
                51.486834743880806
              ],
              [
                5.052680969238281,
                51.48597959517428
              ],
              [
                5.058860778808594,
                51.485231326900056
              ],
              [
                5.068473815917969,
                51.48352095330697
              ],
              [
                5.066070556640625,
                51.47432659610822
              ],
              [
                5.068473815917969,
                51.47143961328641
              ],
              [
                5.0791168212890625,
                51.47400582926133
              ],
              [
                5.076198577880859,
                51.47860327187394
              ],
              [
                5.082893371582031,
                51.48084836613703
              ],
              [
                5.084953308105469,
                51.480313829908056
              ],
              [
                5.089073181152344,
                51.48213122752529
              ],
              [
                5.0887298583984375,
                51.48448304634681
              ],
              [
                5.085639953613281,
                51.48833121552649
              ],
              [
                5.088386535644531,
                51.49078959803455
              ],
              [
                5.085124969482422,
                51.493995984702835
              ],
              [
                5.085124969482422,
                51.498270816123465
              ],
              [
                5.083408355712891,
                51.50094238217541
              ],
              [
                5.078945159912109,
                51.49805708407408
              ],
              [
                5.07568359375,
                51.49955318737237
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.6256,
      5.2701,
      'natuurgebied',
      'Landgoed Jagershagen',
      'Op Jagershagen heerst een waanzinnige rust.',
      '{
        "type": "Feature",
        "properties": {
          "categorie": "Natuurgebied",
          "frequentie": "altijd",
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Landgoed Jagershagen",
          "beschrijving": "Op Jagershagen heerst een waanzinnige rust."
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.273523330688477,
                51.620787668323544
              ],
              [
                5.275239944458008,
                51.62430461483869
              ],
              [
                5.274467468261718,
                51.624624323732334
              ],
              [
                5.2754974365234375,
                51.627181913781925
              ],
              [
                5.275154113769531,
                51.626968786784516
              ],
              [
                5.274295806884766,
                51.62782128876692
              ],
              [
                5.272579193115234,
                51.62792785038835
              ],
              [
                5.272321701049805,
                51.62963280229043
              ],
              [
                5.276527404785156,
                51.63011230846783
              ],
              [
                5.277128219604492,
                51.63155079658897
              ],
              [
                5.277900695800781,
                51.63203028249242
              ],
              [
                5.278587341308594,
                51.634001449067924
              ],
              [
                5.277643203735352,
                51.63432108962992
              ],
              [
                5.274209976196289,
                51.634001449067924
              ],
              [
                5.274209976196289,
                51.63250976332741
              ],
              [
                5.2727508544921875,
                51.63155079658897
              ],
              [
                5.272836685180664,
                51.630911474166794
              ],
              [
                5.268545150756836,
                51.63005903025397
              ],
              [
                5.268630981445312,
                51.62846065474101
              ],
              [
                5.267429351806641,
                51.62894017330822
              ],
              [
                5.266313552856445,
                51.62707535040838
              ],
              [
                5.263824462890625,
                51.628140972880324
              ],
              [
                5.262107849121094,
                51.628513934832114
              ],
              [
                5.261421203613281,
                51.62792785038835
              ],
              [
                5.26820182800293,
                51.62409147432471
              ],
              [
                5.266571044921875,
                51.622652749666635
              ],
              [
                5.2658843994140625,
                51.62339876073947
              ],
              [
                5.265111923217773,
                51.62259946269207
              ],
              [
                5.266141891479492,
                51.622119877105206
              ],
              [
                5.26545524597168,
                51.62132055652962
              ],
              [
                5.266313552856445,
                51.62105411320881
              ],
              [
                5.266656875610351,
                51.62025477385954
              ],
              [
                5.268030166625977,
                51.620467932396075
              ],
              [
                5.268888473510742,
                51.619935034177345
              ],
              [
                5.273523330688477,
                51.620787668323544
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.4667,
      5.1062,
      'natuurgebied',
      'Roovertsche Heide',
      'Hier vliegt de vlinder het groentje en kruipen levendbarende hagedissen. Allemaal dankzij het open kappen van dit gebied.',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Roovertsche Heide",
          "frequentie": "altijd",
          "categorie": "Natuurgebied",
          "beschrijving": "Hier vliegt de vlinder het groentje en kruipen levendbarende hagedissen. Allemaal dankzij het open kappen van dit gebied."
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.0887298583984375,
                51.472615813527405
              ],
              [
                5.099887847900391,
                51.45368600035086
              ],
              [
                5.102977752685547,
                51.454434786162615
              ],
              [
                5.104179382324219,
                51.4524023389559
              ],
              [
                5.122547149658203,
                51.45914115860514
              ],
              [
                5.1216888427734375,
                51.46010376591622
              ],
              [
                5.123405456542968,
                51.4605315848711
              ],
              [
                5.122718811035156,
                51.46224282058793
              ],
              [
                5.12683868408203,
                51.462349770689805
              ],
              [
                5.126152038574219,
                51.46534427178355
              ],
              [
                5.123577117919922,
                51.46523732869949
              ],
              [
                5.109844207763672,
                51.47806870933155
              ],
              [
                5.108985900878906,
                51.47721339623208
              ],
              [
                5.10486602783203,
                51.48063455239723
              ],
              [
                5.099201202392578,
                51.479137828151224
              ],
              [
                5.100574493408203,
                51.47732031124663
              ],
              [
                5.0887298583984375,
                51.472615813527405
              ]
            ]
          ]
        }
      }'
    );
    } 

    public function AddProjectPoint($lat, $lng)
    {
      factory(App\Models\ProjectPoint::class)->create([
        'location' => new Point($lat, $lng),
        'area' => Geometry::fromJson('{
                "type": "FeatureCollection",
                "features": [
                  {
                    "type": "Feature",
                    "properties": {},
                    "geometry": {
                      "type": "Point",
                      "coordinates": [
                        ' . $lat . ',
                        ' . $lng . '
                      ]
                    }
                  }
                ]
              }')
      ]);
  }

  public function AddProjectPointFromJSON($lat, $lng, $category, $title, $description, $json)
  {
    factory(App\Models\ProjectPoint::class)->create([
      'location' => new Point($lat, $lng),
      'area' => Geometry::fromJson(
        '{
          "type": "FeatureCollection",
          "features": [' . $json . '] }'
      ),
      'category' => $category,
      'name' => $title,
      'information' => $description
    ]);
  }
}
