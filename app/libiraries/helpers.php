<?php

function GetPage($quest_count,$limit,$p,$func = 'href'){
    if($quest_count <= $limit) return '';
    $p = new PageView($quest_count,$limit,$p+1,array(),$func);
    //生成页码
    return  $p->echoPageAsDiv();
}

function splash($status,$msg,$data=''){
    if(empty($data)){
        $data = '';
    }
    $arr = array('status'=>$status,'msg'=>$msg,'data'=>$data);

    ajax_response(json_encode($arr));
}

function ajax_response($response){

    if(is_array($response))$response = json_encode($response);

    if(!empty($_REQUEST['jsonpcallback'])){
        header('content-type:text/javascript;charset＝utf-8');
        $response = $_REQUEST['jsonpcallback']."(".$response.")";
    }

    die($response);
}

function checkmobile() {
    global $_G;
    $mobile = array();
    //各个触控浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
    static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini', 'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung', 'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser', 'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource', 'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone', 'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop', 'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
    //window手机浏览器数组【猜的】
    static $mobilebrowser_list =array('windows phone');
    //wap浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
    static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom', 'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh', 'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
    $pad_list = array('pad', 'gt-p1000');
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if(dstrpos($useragent, $pad_list)) {
        return false;
    }
    if(($v = dstrpos($useragent, $mobilebrowser_list, true))){
        $_G['mobile'] = $v;
        return '1';
    }
    if(($v = dstrpos($useragent, $touchbrowser_list, true))){
        $_G['mobile'] = $v;
        return '2';
    }
    if(($v = dstrpos($useragent, $wmlbrowser_list))) {
        $_G['mobile'] = $v;
        return '3'; //wml版
    }
    $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
    if(dstrpos($useragent, $brower)) return false;
    $_G['mobile'] = 'unknown';
    //对于未知类型的浏览器，通过$_GET['mobile']参数来决定是否是手机浏览器
    if(isset($_G['mobiletpl'][$_GET['mobile']])) {
        return true;
    } else {
        return false;
    }
}

function dstrpos($string, $arr, $returnvalue = false) {
    if(empty($string)) return false;
    foreach((array)$arr as $v) {
        if(strpos($string, $v) !== false) {
            $return = $returnvalue ? $v : true;
            return $return;
        }
    }
    return false;
}

function get_real_ip(){
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match("/^(10|172\.16|192\.168)\./", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

?>