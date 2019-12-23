<?php

namespace App\Http\Controllers;

use App\Models\Media;

use App\Models\PointHasImage;
use App\Models\ProjectHasImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    private function is_valid_name($file)
    {
        return preg_match('/^([-\.\w]+)$/', $file) > 0;
    }

    //Needs a name for the file that the user wants to save + a folder (projects/points) (you can find these folders in public/img/) + the request needs an image as well + the id of the project/point which the image is connected to
    public function saveMedia(Request $request)
    {
        $image = $request->file('image');
        if (isset($request["name"]) && isset($request['folder']) && $image && isset($request["id"])) {
            $request["name"] = htmlspecialchars($request["name"], ENT_QUOTES, 'UTF-8');
            if (!$this->is_valid_name($request["name"])) {
                return abort(302, "Bestandsnaam is niet toegestaan, de naam mag geen speciale tekens bevatten");
            }

            $id = $request["id"];
            $folder = $request["folder"];

            // 1. Check how many images the project/point has
            // 2. Generate the new name for the image.
            $mediaRow = ($folder == "projects") ? ProjectHasImage::where('project_id', $id) : PointHasImage::where('point_id', $id);
            $newMediaName = $this->createNameForMedia($id, $mediaRow);
            $path = $folder . "/" . $newMediaName . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path, File::get($image));
            $media = new Media;
            $media->fill(["name" => (($folder === "projects") ? 'p_' : 'i_') . $newMediaName, "path" => $path]);
            $media->save();

            if ($folder == "projects") {
                $phi = new ProjectHasImage();
                $phi->project_id = $id;
                $phi->media_name = 'p_' . $newMediaName;
                $phi->save();
                return json_encode($phi);
            } else if ($folder == "points") {
                $phi = new PointHasImage();
                $phi->point_id = $id;
                $phi->media_name = 'i_' . $newMediaName;
                $phi->save();
                return json_encode($phi);
            }
            //return view('mediaExample', ["media" => $media]);
        } else {
            if (isset($request["name"])) {
                return abort(400, "file image is not set");
            } else if (isset($request['folder'])) {
                return abort(400, "folder is not set");
            } else if ($image) {
                return abort(400, "image is not set");
            } else if (isset($request["id"])) {
                return abort(400, "id is not set");
            }
        }
    }


    /**r
     * @param $mediaUsedByProject The media has project/point model
     * @return string return the name of the media
     */
    private function createNameForMedia($id, $mediaUsedByProject)
    {
        $media = Media::find($mediaUsedByProject->get(['media_name']));
        $highestPictureNumber = 0;
        foreach ($media->toArray() as $key => $value) {
            $matches = '';

            preg_match('/\d+(?=\.)/', $value['path'], $matches);
            if ((int)$matches[0] >= $highestPictureNumber) {
                $highestPictureNumber = (int)$matches[0] + 1;
            }
        }
        return $id . '_' . $highestPictureNumber;
    }

    //media (name from media which needs to be deleted)
    //folder in which it has to search (projects/points)
    public function removeMedia(Request $request)
    {
        if (isset($request->medianame) && ($request->folder == "projects" || $request->folder == "points")) {
            $media = Media::find($request->medianame);
            Storage::disk('public')->delete($media->path);
            $media->delete();
        } else return abort(400);
    }

    //returns media based on a given name
    public function getMedia($name)
    {
        $media = Media::find($name);
        $file = null;
        if (!empty($media)) {
            $file = Storage::disk('public')->get($media->path);
        }
        return new Response($file, 200);
    }

}
