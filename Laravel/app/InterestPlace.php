<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class InterestPlace extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'project_id',
        'point',
        'area',
        'name',
        'information',
    ];

    protected $spatialFields = [
        'location',
        'area'
    ];
}
