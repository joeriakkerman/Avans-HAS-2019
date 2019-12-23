<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'route';
    protected $id = 'id';
    protected $fillable = ['name', 'length'];

    // Table does not have timestamps
    public $timestamps = false;

    public function project_points()
    {
        return $this->hasMany('App\Models\ProjectPoint');
    }
}
