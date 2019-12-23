<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectHasImage extends Model
{
    protected $table = "project_has_image";
    protected $primaryKey = ["project_id", "media_name"];
    public $timestamps = false;
    public $incrementing = false;

    public function media(){
        return $this->belongsTo("App\Models\Media");
    }
}