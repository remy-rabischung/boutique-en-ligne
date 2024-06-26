<?php 

class Utils{
    public static function getDataFromRequest(){
        return json_decode(file_get_contents('php://input'));
    }
}