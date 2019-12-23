<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $points = Array();

        for ($i = 0; $i < sizeof($request->latlngs); $i++) {
            $lat = $request->latlngs[$i][0];
            $lng = $request->latlngs[$i][1];
            $points[$i] = new Point($lat, $lng);
        }
        $lat = $request->latlngs[0][0];
        $lng = $request->latlngs[0][1];
        $points[sizeof($points)] = new Point($lat, $lng);


        $area = new GeometryCollection([new Polygon([new LineString($points)])]);
        $point = new Project();
        if (isset($request->category) && isset($request->name) && isset($request->information)) {
            $point->area = $area;
            $point->name = $request->name;
            $point->information = $request->information;
            $point->category = $request->category;
            $point->save();
        } else {
            return abort(400);
        }

        return $point;
    }

    public function searchForName($name)
    {
        if (isset($name)) {
            return json_encode(Project::where("name", "LIKE", "%" . $name . "%")->get());
        } else return abort(400);
    }

    public function create()
    {
        return view('createProject');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return $project->toJson();
    }

    public function update(Request $request)
    {
        $points = Array();

        for ($i = 0; $i < sizeof($request->latlngs); $i++) {
            $lat = $request->latlngs[$i][0];
            $lng = $request->latlngs[$i][1];
            $points[$i] = new Point($lat, $lng);
        }
        $lat = $request->latlngs[0][0];
        $lng = $request->latlngs[0][1];
        $points[sizeof($points)] = new Point($lat, $lng);

        $area = new GeometryCollection([new Polygon([new LineString($points)])]);

        if (isset($request->id) && isset($request->name) && isset($request->information) && isset($request->category)) {
            $project = Project::find($request->id);
            $project->name = $request->name;
            $project->information = $request->information;
            $project->category = $request->category;
            $project->area = $area;
            $project->save();
            return json_encode($project);
        } else {
            return abort(400);
        }
    }

    public function getProjects()
    {
        return json_encode(Project::all());
    }

    public function getAllMapObjects()
    {
        $projects = Project::all();
        $points = ProjectPoint::all();
        $arr = [];
        foreach ($projects as $project) $arr[] = $project;
        foreach ($points as $point) $arr[] = $point;
        return json_encode($arr);
    }

    public function getMedia($id)
    {
        if (!isset($id)) return abort(400);
        $model = Project::find($id);
        $images = $model->imageProjects;
        $names = [];
        foreach ($images as $image) $names[] = $image->media_name;
        return json_encode($names);
    }

    /**
     * @param Request $request
     *      pointWKT: Well Known Text for Point
     *      withinDistance:
     *
     * @return Return Point Models
     */
    public function getProjectWithinDistance(Request $request)
    {
        $usersPosition = Point::fromWKT($request->pointWKT);
        $containsPoint = Project::distance('location', $usersPosition, $request->withinDistance)->get();

        return $containsPoint->toJson();
    }

    /**
     * @param Request $request
     *      id: project_id
     *
     * @return Return View project
     */
    public function getProject(Request $request)
    {
        if (!isset($request->id)) return abort(400);
        return json_encode(Project::find($request->id));
    }

    public function main()
    {
        return view('beheerder.MainModeratorPage');
    }

    public function facetInfo(Request $request)
    {
        $project = Project::find($request['project']);
        return view('project')->with(["project" => $project, "facet_id" => $request['facet_id'], "direction" => $request['direction']]);
    }

    public function remove(Request $request)
    {
        if (isset($request->id)) {
            Project::find($request->id)->delete();
        } else return abort(400);
    }
}
