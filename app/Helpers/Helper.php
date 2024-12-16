<?php
namespace App\Helpers;

class Helper{

    public static function result($message,$statuscode,$data=null,){
        return response()->json([
            "message"=>$message,
            "data"=>$data,
        ],$statuscode);
    }
}