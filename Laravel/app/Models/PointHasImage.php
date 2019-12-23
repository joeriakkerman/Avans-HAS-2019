<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointHasImage extends Model
{
    protected $table = "point_has_image";
    protected $primaryKey = ["point_id", "media_name"];
    public $timestamps = false;
    public $incrementing = false;

    public function media(){
        return $this->belongsTo("App\Models\Media");
    }
}