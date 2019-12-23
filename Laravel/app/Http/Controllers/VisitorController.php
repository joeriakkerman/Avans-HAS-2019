<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function getAllVisitors(){
        return json_encode(Visitor::all());
    }

    public static function addVisitor(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        date_default_timezone_set('Europe/Amsterdam');
        $date = date('Y-m-d', time());

        $visitor = Visitor::where("IP", $ip)->where("date", $date)->first();

        if(!isset($visitor) && isset($ip) && isset($date)){
            $visitor = new Visitor();
            $visitor->IP = $ip;
            $visitor->date = $date;
            $visitor->saveOrFail();
        }
    }
}
