<?php

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
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

        // Project needs a category.
        DB::table('category')->insert([
            'name' => 'natuurgebied',
        ]);
        DB::table('category')->insert([
            'name' => 'bezienswaardigheid',
        ]);
        DB::table('category')->insert([
            'name' => 'eten en drinken',
        ]);
        DB::table('category')->insert([
            'name' => 'activiteit',
        ]);

        $this->AddProjectPointFromJSON(
            'natuurgebied',
            'De Loonse en Drunense Duinen',
            'Nationaal Park De Loonse en Drunese duinen voelt aan alsof u in de Sahara bent. Het droge en woeste landschap is erg uniek. Het is het grootste levende stuifzandgebied van West- Europa. Voor iedere natuurliefhebber een indrukwekkende bezienswaardigheid.',
            '{
          "type": "Feature",
          "properties": {
            "stroke": "#008000",
            "stroke-width": 2,
            "stroke-opacity": 1,
            "fill": "#0ea701",
            "fill-opacity": 0.5,
            "gebied_naam": "De Loonse en Drunense Duinen",
            "bezienswaardigheid_naam": "",
            "beschrijving": "Nationaal Park De Loonse en Drunese duinen voelt aan alsof u in de Sahara bent. Het droge en woeste landschap is erg uniek. Het is het grootste levende stuifzandgebied van West- Europa. Voor iedere natuurliefhebber een indrukwekkende bezienswaardigheid.",
            "categorie": "Natuurgebied",
            "frequentie": "altijd"
          },
          "geometry": {
            "type": "Polygon",
            "coordinates": [
              [
                [
                  5.101430911828976,
                  51.677244147152756
                ],
                [
                  5.08837369408938,
                  51.674259179908944
                ],
                [
                  5.0808196492714455,
                  51.671069529196984
                ],
                [
                  5.081879266417853,
                  51.66851098584514
                ],
                [
                  5.082221078400565,
                  51.66532133513318
                ],
                [
                  5.089057318054803,
                  51.663820323033434
                ],
                [
                  5.091142371149346,
                  51.661261779681595
                ],
                [
                  5.084613762279548,
                  51.660425988853326
                ],
                [
                  5.0856391982276845,
                  51.65721928118569
                ],
                [
                  5.0856391982276845,
                  51.65466073783385
                ],
                [
                  5.079452401340598,
                  51.65658817382557
                ],
                [
                  5.072240168505376,
                  51.658720293285434
                ],
                [
                  5.069163860660969,
                  51.656161749933595
                ],
                [
                  5.064686123687442,
                  51.65636643340174
                ],
                [
                  5.058157514817644,
                  51.654882478257676
                ],
                [
                  5.0543975830078125,
                  51.652528618373985
                ],
                [
                  5.0543975830078125,
                  51.64891254377005
                ],
                [
                  5.056790266886796,
                  51.64444362138217
                ],
                [
                  5.059217131964051,
                  51.63975295857047
                ],
                [
                  5.059900755929474,
                  51.63528403618259
                ],
                [
                  5.06263525179117,
                  51.63165090462297
                ],
                [
                  5.068138424712832,
                  51.6318726450468
                ],
                [
                  5.075008845565343,
                  51.632725492830744
                ],
                [
                  5.078426965392462,
                  51.634431188398636
                ],
                [
                  5.083930138314124,
                  51.634431188398636
                ],
                [
                  5.087348258141244,
                  51.63101979726285
                ],
                [
                  5.092851431062906,
                  51.62951878516311
                ],
                [
                  5.098354603984569,
                  51.631224480731
                ],
                [
                  5.107959520698774,
                  51.63420944797481
                ],
                [
                  5.118248061378403,
                  51.638047263002576
                ],
                [
                  5.122042174386506,
                  51.63634156743468
                ],
                [
                  5.120298933274675,
                  51.63293017629889
                ],
                [
                  5.126143918179049,
                  51.631224480731
                ],
                [
                  5.124093046282778,
                  51.62823951348719
                ],
                [
                  5.126485730161761,
                  51.625902710559174
                ],
                [
                  5.126485730161761,
                  51.622713059847214
                ],
                [
                  5.122042174386506,
                  51.61950635217958
                ],
                [
                  5.119615309309252,
                  51.61609496104379
                ],
                [
                  5.11585537749942,
                  51.61268356990801
                ],
                [
                  5.118589873361115,
                  51.60841933098827
                ],
                [
                  5.12272579835193,
                  51.61012502655616
                ],
                [
                  5.1275111661098975,
                  51.6143892654759
                ],
                [
                  5.1302798431698635,
                  51.61865350439563
                ],
                [
                  5.137150264022374,
                  51.61865350439563
                ],
                [
                  5.1436446916939005,
                  51.61694780882774
                ],
                [
                  5.152258353658242,
                  51.62121204774747
                ],
                [
                  5.1615214583897355,
                  51.62377059109931
                ],
                [
                  5.173860870965637,
                  51.62803483001904
                ],
                [
                  5.181073103800859,
                  51.63037163294705
                ],
                [
                  5.181756727766283,
                  51.63400476450666
                ],
                [
                  5.179364043887299,
                  51.63698973175048
                ],
                [
                  5.172835435017501,
                  51.63634156743468
                ],
                [
                  5.162546894337871,
                  51.63400476450666
                ],
                [
                  5.153967413571801,
                  51.63528403618259
                ],
                [
                  5.150856924529123,
                  51.638695427318375
                ],
                [
                  5.161179646407024,
                  51.63912185121035
                ],
                [
                  5.179022231904587,
                  51.63954827510232
                ],
                [
                  5.195497569471303,
                  51.64082754677824
                ],
                [
                  5.211972907038018,
                  51.64422188095835
                ],
                [
                  5.217817891942392,
                  51.64848611987808
                ],
                [
                  5.212656531003442,
                  51.65530890214965
                ],
                [
                  5.205102486185508,
                  51.660425988853326
                ],
                [
                  5.198949870496693,
                  51.6659524424933
                ],
                [
                  5.170784563121229,
                  51.66893740973711
                ],
                [
                  5.148122428667428,
                  51.66893740973711
                ],
                [
                  5.126485730161761,
                  51.669363833629085
                ],
                [
                  5.1120612644913175,
                  51.671274212665125
                ],
                [
                  5.101430911828976,
                  51.677244147152756
                ]
              ]
            ]
          }
        }'
        );
        // Example of changing default values of the factory.
//        factory(App\Models\Project::class)->create([
//            'name' => 'Abigail',
//        ]);
    }

    public function AddProjectPoint($lat, $lng)
    {
        factory(App\Models\Project::class)->create([
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


    public function AddProjectPointFromJSON($category, $title, $description, $json)
    {
        factory(App\Models\Project::class)->create([
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
