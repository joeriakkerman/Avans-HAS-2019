<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PointHasImage;
use App\Models\Project;
use App\Models\ProjectHasImage;
use App\Models\ProjectPoint;
use Grimzy\LaravelMysqlSpatial\Types\GeometryCollection;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;


use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use Validator;

class ProjectPointsController extends Controller
{
    // Return view
    public function create()
    {
        return view('createProjectPoint');
    }

    public function viewProjectPoints()
    {
        return view('mainCrudPage');
    }

    // Methods
    public function getProjectPoints()
    {
        $points = ProjectPoint::all();
        return $points->toJson();
    }
    public function getSingleProjectPoint($id)
    {
        $points = ProjectPoint::where('id', $id)->get();
        return $points;
    }


    public function addProjectPoint(Request $request)
    {
        $point = new ProjectPoint();

        $location = new Point($request->markerLat, $request->markerLong);
        if($request->project_id ===null){

        }else{
            $point->project_id = $request->project_id;

        }

        $point->location = $location;
        $point->area = new GeometryCollection([$location]);
        $point->name = $request->name;
        $point->information = $request->information;
        $point->category = $request->category;

        $point->save();
        return json_encode($point);
    }

    public function edit($id)
    {
        $point = ProjectPoint::find($id);
        return $point->toJson();
    }

    public function update(Request $request)
    {
        $projectPoint = ProjectPoint::find($request->id);

        $location = new Point($request->lat, $request->long);
        if($request->project_id ===null){

        }else{
            $projectPoint->project_id = $request->project_id;

        }
        $projectPoint->project_id = $request->project_id;
        $projectPoint->location = $location;
        $projectPoint->area = new GeometryCollection([$location]);
        $projectPoint->name = $request->name;
        $projectPoint->information = $request->information;
        $projectPoint->category = $request->category;
        $projectPoint->save();

        return json_encode($projectPoint);
    }

    public function destroy(Request $request)
    {
        $point = ProjectPoint::findOrFail($request->id);
        $point->delete();
    }

    public function getLocationData(Request $request)
    {
        $allowedLocations = [];
        $pointsInfo = ProjectPoint::select('geo_json')->get();
        /*for ($i=0; $i < $pointInfo.count(); $i){
            if($pointInfo[$i]->distance < $request->distance){
                array_push($allowedLocations, $pointInfo[$i]);
            }
        }*/

        //return json_encode($pointsInfo);
        //return json_encode($allowedLocations);
    }

    public function getDetails($id)
    {
        // Loading model
        $model = ProjectPoint::find($id);

        if (empty($model)) {
            return view('/project');
        }

        $project = $model->project;

        /*
        $testModel = array(
            'name' => 'Test name',
            'information' => 'Test description'
        );
        */

        // Check if model has been found in DB
        if (!empty($model)) {
            return view('details', ['model' => $model]);
        }

        return abort(404);
    }

    public function getAllPointsFullInfo()
    {
        return json_encode(ProjectPoint::all());
    }

    public function getSimilarInterestPoints(Request $request)
    {
        $id = $request->id;
        $category = $request->category;

        $projectPoints = ProjectPoint::where(['category' => $category, ['id', '!=', $id]])->inRandomOrder()->limit(3)->get();

        $ids = array_pluck($projectPoints, 'id');
        $images = [];

        $pointHasImage = PointHasImage::whereIn('point_id', $ids)->get();

        for ($i = 0; $i < count($pointHasImage); $i++){
            if(in_array($pointHasImage[$i]->point_id, $images)) continue;
            $images[] = ['id' => $pointHasImage[$i]->point_id, 'location' => $pointHasImage[$i]->media_name];
        }

        return json_encode([$projectPoints, $images]);
    }

    public function getSimilarProjects(Request $request)
    {
        $id = $request->id;
        $category = $request->category;

        $projects = Project::where(['category' => $category, ['id', '!=', $id]])->inRandomOrder()->limit(3)->get();

        $ids = array_pluck($projects, 'id');
        $images = [];

        $projectHasImage = ProjectHasImage::whereIn('project_id', $ids)->get();

        for ($i = 0; $i < count($projectHasImage); $i++){
            if(in_array($projectHasImage[$i]->project_id, $images)) continue;
            $images[] = ['id' => $projectHasImage[$i]->project_id, 'location' => $projectHasImage[$i]->media_name];
        }

        return json_encode([$projects, $images]);
    }

    public function getAllPoints()
    {
        $points = ProjectPoint::all();
        $arr = [];
        foreach ($points as $point) {
            if ($point["area"] != null) {
                $arr[] = ["id" => $point["id"], "info" => $point["area"], "category" => $point->category];
            } else {
                $arr[] = ["id" => $point["id"], "info" => $point["location"], "category" => $point->category];
            }
        }
        return json_encode($arr);
    }

    public function searchForName($name)
    {
        if (isset($name)) {
            return json_encode(ProjectPoint::where("name", "LIKE", "%" . $name . "%")->get());
        } else return abort(400);
    }

    public function getProjectPointByID($projectPointId)
    {
        $model = ProjectPoint::find($projectPointId);
        $model["comments"] = $model->comments;
        return json_encode($model);
    }



    public function getMedia($id)
    {
        if (!isset($id)) return abort(400);
        $model = ProjectPoint::find($id);
        $images = $model->imagePoints;
        $names = [];
        foreach ($images as $image) $names[] = $image->media_name;
        return json_encode($names);
    }

    public function createPoint(Request $request)
    {
        if (isset($request->lat) && isset($request->long) && isset($request->name) && isset($request->information)) {
            $point = new ProjectPoint();
            $point->project_id = $request->project_id;
            $point->location = new Point($request->lat, $request->long);
            if (isset($request->area)) $point->area = $request->area;
            $point->name = $request->name;
            $point->information = $request->information;
            $point->category = $request->category;
            $point->save();
            return json_encode($point);
        } else {
            return abort(400);
        }
    }

    public function updatePoint(Request $request)
    {
        if (isset($request->id) && isset($request->lat) && isset($request->long) && isset($request->name) && isset($request->information)) {
            $point = ProjectPoint::find($request->id);
            $point->project_id = $request->project_id;
            $point->location = new Point($request->lat, $request->long);
            if (isset($request->area)) $point->area = $request->area;
            $point->name = $request->name;
            $point->information = $request->information;
            $point->category = $request->category;
            $point->save();
            return json_encode($point);
        } else {
            return abort(400);
        }
    }

    public function removePoint(Request $request)
    {
        if (isset($request->id)) {
            ProjectPoint::find($request->id)->delete();
        } else return abort(400);
    }
}
