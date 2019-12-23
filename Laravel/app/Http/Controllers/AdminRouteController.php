<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPoint;
use App\Models\Route;

use App\Models\RouteHasProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;


class AdminRouteController extends Controller
{
    function getView(){
        return view('ManageRoutes');
    }

    function getRouteData()
    {
        $points = ProjectPoint::all();
        $routes = Route::all();
        $routePoints = RouteHasProjectPoint::all();

        return (['points' => $points, 'routes' => $routes, 'routePoints' => $routePoints]);
    }

    function getProjectPoint(Request $request){

        $id = $request->id;
        $projectPoints = ProjectPoint::where('id', $id)->get();

        return $projectPoints;
    }

    function insertMarkers(Request $request){

        $latlng = $request->latlng;
        $markerNames = $request->name;
        $markerInfo = $request->info;

        var_dump($latlng);
        for ($i = 0; $i < sizeof($latlng); $i++) {
            $projectpoint = new ProjectPoint;
            $point = new Point($latlng[$i]['lat'], $latlng[$i]['lng']);

            $projectpoint->project_id = 1;
            $projectpoint->location = $point;
            $projectpoint->geo_json = new GeometryCollection([$point]);
            $projectpoint->name = $markerNames[$i];
            $projectpoint->information = 'Temporary information';

            $projectpoint->save();
        }
    }

    //TODO (bug) spatial data word niet geconverd met een join
    function getRoutePoints(Request $request){
        $routeId = $request->routeId;
        $response = [];

        $ids = RouteHasProjectPoint::select('point_id')
            ->where('route_id', $routeId)
            ->get();
        //Twee querys voor de spatial data
        $routePoints = ProjectPoint::whereIn('id', $ids)->get();

        /*foreach($routePoints as $r){
             array_push($response, [$r->id, $r->location]);
        }*/
        return $routePoints;
    }

    function createRoute(Request $request){

        $ids = $request->ids;
        $latlngs = $request->latlngs;

        $distance = $request->distance;
        $routeName = $request->name;

        if (count($latlngs) < 2) {
            return "Not enough markers to create a route!";
        }
        //TODO check if route has changed (has less markers) compaired to the current route in database
        $route = Route::where('name', $routeName)->first();
        $newRoute = null;

        if($route === null){

            $newRoute = new Route();

            $newRoute->name = $routeName;
            $newRoute->length = round($distance / 1000, 2);
            $newRoute->save();

            $route = Route::where('name', $routeName)->first();
        } else {
            $route->length = round($distance / 1000, 2);
            $route->save();
        }

        //Delete old route before adding the new one
        RouteHasProjectPoint::where('route_id', $route->id)->delete();

        for ($i = 0; $i < count($ids); $i++) {
            $routepoints = new RouteHasProjectPoint();

            $routepoints->point_id = $ids[$i];
            $routepoints->route_id = $route->id;
            $routepoints->save();
        }
        return 'Route added to database!';
    }

    function removeRoute(Request $request)
    {
        if (isset($request["routeID"])) {
            $route = Route::find($request["routeID"]);
            if (!empty($route) && isset($route)) {
                $route->delete();
                return "Successfully deleted route " . $route->name;
            }
        }
        return "Could not remove route because route does not exist";
    }
}
