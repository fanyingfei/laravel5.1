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

?>