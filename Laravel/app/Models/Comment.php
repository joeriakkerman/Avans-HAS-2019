<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $primaryKey = "id";
    protected $fillable = ["point_id", "text"];
    public $timestamps = true;
    public $incrementing = true;

}
