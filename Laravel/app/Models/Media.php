<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Media extends Model
{
    protected $table = "media";
    protected $primaryKey = "name";
    protected $fillable = ["name", "path"];
    public $timestamps = false;
    public $incrementing = false;

    //returns the file type (extension)
    public function getExtension(){
        $arr = explode(".", $this->path);
        if(count($arr) != 2) return null;
        else return $arr[1];
    }
}
