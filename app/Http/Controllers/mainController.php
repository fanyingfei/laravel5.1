<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Base;
use App\Model\Fitment;
use App\Model\Image;
use App\Model\Retrofit;
use App\Model\Bespeak;
use App\Model\Floor;
use App\Model\Access;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cookie;

class MainController extends Controller
{
    const banner_type = 0;   //轮播
    const style_type = 1;  //风格
    const house_type = 2;  //户型
    const space_type = 3;  //空间
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    //    Cookie::queue('cookie_for_js', 'can you read me?', 99999999);
    //    print_r(Cookie::get('cookie_for_js'));exit;
        $articles_res = Article::select('rec_id as id','title')->orderBy('sort', 'desc')->take(10)->get()->toArray();
        $base_res = Base::whereIn('type', array(self::banner_type , self::style_type))->orderBy('sort', 'desc')->get()->toArray();
        $banner_list = $case_list = array();
        foreach($base_res as $row){
            if(empty($row['img_url'])) continue;
            if($row['type'] == self::banner_type && count($banner_list)<6){ //banner最多六张
                $row['style'] = 'url('.$row['img_url'].')';
                $banner_list[] = $row;
            }elseif($row['type'] == self::style_type && count($case_list)<8){ //案例放八张
                $case_list[] = $row;
            }
        }

        $data['body'] = 'home';
        $data['title'] = '上海洵直装饰_墙面刷新_二手房翻新_旧墙翻新';
        $data['nav_title'] = '官网首页';
        $data['keywords'] = '洵直，翻新，刷新，装饰，旧墙翻新';
        $data['description'] = '';
        $data['case_list'] = $case_list;
        $data['article_list'] = $articles_res;
        $data['banner_list'] = $banner_list;
        return view('main.index')->with('data', $data);
    }

    public function about($name=''){
        $name_list = array('bsk'=>'预约查询','qua'=>'质保查询','faq'=>'常见问题');
        $data['body'] = 'about';
        $data['title'] = empty($name_list[$name]) ? '关于我们' : $name_list[$name];
        $data['nav_title'] = empty($name_list[$name]) ? '关于我们' : $name_list[$name];
        $data['curr'] =$name;
        $data['keywords'] = '';
        $data['description'] = '';
        return view('main.about')->with('data', $data);
    }

    public function events($p = 0){
        //动态
        $data = $this->out_events($p , 1);
        $data['curr'] = 'ev';
        $data['title'] = '公司动态_上海洵直装饰';
        $data['nav_title'] = '公司动态';
        return view('main.events')->with('data', $data);
    }

    public function information($p = 0){
        //资讯
        $data = $this->out_events($p , 2);
        $data['curr'] = 'in';
        $data['title'] = '公司资讯_上海洵直装饰';
        $data['nav_title'] = '公司资讯';
        return view('main.events')->with('data', $data);
    }

    public function out_events($p , $type = 0){
        $limit = 5;
        $p = intval($p);
        if($p > 0) $p--;

        if(empty($type)){
            $total_count = Article::count();
            $list_res = Article::select('rec_id as id','title','title_img','create_time')->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }else{
            $total_count = Article::where('type', $type)->count();
            $list_res = Article::select('rec_id as id','title','title_img','create_time')->where('type', $type)->orderBy('create_time', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }
        foreach($list_res as &$row){
            $row['create_time'] = substr($row['create_time'],0,10);
        }
        $pagination = GetPage($total_count,$limit,$p);

        $data['body'] = 'events';
        $data['keywords'] = '';
        $data['description'] = '';
        $data['pagination'] = $pagination;
        $data['events_list'] = $list_res;
        return $data;
    }

    public function show($id){
        $id = intval($id);
        $result = Article::where("rec_id",$id)->first();
        $result['create_time'] = substr($result['create_time'],0,10);

        $data['body'] = 'events';
        $data['title'] = $result['title'];
        $data['nav_title'] = $result['title'];
        $data['keywords'] = $result['keywords'];
        $data['description'] = $result['description'];
        $data['curr'] = $result['type'] == 1 ? 'ev' : 'in';
        return view('main.show')->with(['data'=>$data , 'info'=>$result]);
    }

    public function fitment_img($id){
        $id = intval($id);
        $images_res = Image::where('rec_id', $id)->orderBy('sort', 'desc')->get()->toArray();
        echo json_encode($images_res);
    }

    public function fitment($p = 0){
        $data = $this->out_fitment($p);
        return view('main.fitment')->with('data', $data);
    }

    public function fitment_ts($style , $p = 0){
        $data = $this->out_fitment($p,$style);
        return view('main.fitment')->with('data', $data);
    }

    public function fitment_hs($house , $p = 0){
        $data = $this->out_fitment($p,0,$house);
        return view('main.fitment')->with('data', $data);
    }

    public function fitment_filter($style, $house , $p = 0){
        $data = $this->out_fitment($p,$style,$house);
        return view('main.fitment')->with('data', $data);
    }

    public function out_fitment($p,$fitment_curr=0,$house_curr=0){
        $limit = 12;
        if($p > 0) $p--;
        $base_res = Base::select('name','sign_id','type')->whereIn('type', array(self::style_type ,self::house_type))->orderBy('sort', 'desc')->get()->toArray();
        $house_list = $fitment_list = array();
        array_push($house_list , array('name'=>'不限','sign_id'=>0,'type'=>self::house_type));
        array_push($fitment_list , array('name'=>'不限','sign_id'=>0,'type'=>self::style_type));
        foreach($base_res as $row){
            if($row['type'] == self::style_type) $fitment_list[$row['sign_id']] = $row;
            elseif($row['type'] == self::house_type ) $house_list[$row['sign_id']] = $row;
        }

        if($fitment_curr == 0 && $house_curr == 0){
            $total_count = Fitment::count();
            $list_res = Fitment::orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }elseif($fitment_curr > 0 && $house_curr == 0){
            $total_count = Fitment::where("style",$fitment_curr)->count();
            $list_res = Fitment::where("style",$fitment_curr)->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }elseif($fitment_curr == 0 && $house_curr > 0){
            $total_count = Fitment::where("house",$house_curr)->count();
            $list_res = Fitment::where("house",$house_curr)->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }else{
            $total_count = Fitment::where(['style'=>$fitment_curr,'house'=>$house_curr])->count();
            $list_res = Fitment::where(['style'=>$fitment_curr,'house'=>$house_curr])->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }

        $rec_ids = array_column($list_res,'rec_id');
        $images_res = Image::whereIn('rec_id', $rec_ids)->orderBy('sort', 'desc')->get()->toArray();

        $images_list = array();
        foreach($images_res as $img){
            $images_list[$img['rec_id']][] = $img;
        }

        foreach($list_res as $key=>&$row){
            if(empty($images_list[$row['rec_id']])){
                unset($list_res[$key]);
                continue;
            }
            $row['img_num'] = count($images_list[$row['rec_id']]);
            $row['img_url'] = $images_list[$row['rec_id']][0]['img_url'];
            $row['style'] = empty($fitment_list[$row['style']]) ? '' : $fitment_list[$row['style']]['name'];
            $row['style'] = $row['style'] == '其他' ? '' : $row['style'];
            $row['house'] = empty($house_list[$row['house']]) ? '' : $house_list[$row['house']]['name'];
        }

        $pagination = GetPage($total_count,$limit,$p);

        $data['body'] = 'fitment';
        $data['title'] = '新房装修_上海洵直装饰';
        $data['nav_title'] = '新房装修';
        $data['keywords'] = '';
        $data['description'] = '';
        $data['pagination'] = $pagination;
        $data['list'] = $list_res;
        $data['house_list'] = $house_list;
        $data['curr'] = 'fitment';
        $data['house_curr'] = $house_curr;
        $data['fitment_list'] = $fitment_list;
        $data['fitment_curr'] = $fitment_curr;
        return $data;
    }

    public function floor(){
        $list_res = Floor::where("type",1)->orderBy('rec_id', 'asc')->get()->toArray();
        $data['list'] = $list_res;
        $data['body'] = 'floor';
        $data['curr'] = 'hot';
        $data['title'] = '自热地板_上海洵直装饰';
        $data['nav_title'] = '自热地板';
        $data['keywords'] = '';
        $data['description'] = '';
        return view('main.hot')->with('data', $data);
    }

    public function floor_general(){
        $list_res = Floor::where("type",0)->orderBy('rec_id', 'asc')->get()->toArray();
        $data['list'] = $list_res;
        $data['body'] = 'floor';
        $data['curr'] = 'common';
        $data['title'] = '普通地板_上海洵直装饰';
        $data['nav_title'] = '普通地板';
        $data['keywords'] = '';
        $data['description'] = '';
        return view('main.general')->with('data', $data);
    }

    public function retrofit(){
        $data = $this->out_retrofit();
        $data['body'] = 'wall';
        $data['title'] = '墙面翻新_上海洵直装饰';
        $data['nav_title'] = '墙面翻新';
        return view('main.wall')->with('data', $data);
    }

    public function retrofit_part(){
        $data = $this->out_retrofit('part');
        $data['body'] = 'part';
        $data['title'] = '局部翻新_上海洵直装饰';
        $data['nav_title'] = '局部翻新';
        $space_res = Base::select('name','sign_id')->where('type', self::space_type)->where('sign_id', '!=' , 0)->orderBy('sort', 'desc')->get()->toArray();

        $data['space_list'] = $space_res;
        return view('main.part')->with('data', $data);
    }

    public function data_query(){
        $mobile = trim($_POST['mobile']);
        if(empty($mobile)) splash('error','请输入手机号');
        if(!preg_match("/^1[345789]{1}\d{9}$/",$mobile)) splash('error','请输入正确手机号');

        $type = isset($_POST['t']) ? $_POST['t'] : 'all';
        if($type == 'all'){
            $res = Bespeak::select('name','address','create_time','remark')->where('mobile',$mobile)->where('type','<',3)->get()->toArray();
        }else{
            $res = Bespeak::select('name','address','keep_time','year','remark')->where(['mobile'=>$mobile,'type'=>$type])->get()->toArray();
        }

        foreach($res as &$v){
            $v['name'] = mb_substr($v['name'],0,1,'utf-8').'***';
            $v['address'] = mb_substr($v['address'],0,5,'utf-8').'***';
            $v['remark'] = htmlspecialchars($v['remark']);
            if(!empty($v['create_time'])) $v['create_time'] = substr($v['create_time'],0,10);
        }

        if($res){
            splash('success','',$res);
        }else{
            splash('error','没有查询结果');
        }
    }

    public function retrofit_page($curr){
        $t = intval($_REQUEST['t']);
        $p = intval($_REQUEST['p']);
        $data = $this->out_retrofit($curr,$p,$t);
        echo json_encode(array('list'=>$data['list'],'page'=>$data['pagination']));
    }

    public function out_retrofit($curr = 'wall' , $p = 0 , $t = 0){
        $limit = 12;
        if($p > 0) $p--;
        if($curr == 'wall'){
            $total_count = Retrofit::where("type",0)->count();
            $list = Retrofit::where("type",0)->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
        }else{
            if($t == 0){
                $total_count = Retrofit::where("type",'!=',0)->count();
                $list = Retrofit::where("type",'!=',0)->orderBy('type', 'asc')->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
            }else{
                $total_count = Retrofit::where("type",$t)->count();
                $list = Retrofit::where("type",$t)->orderBy('rec_id', 'desc')->skip($p*$limit)->take($limit)->get()->toArray();
            }
        }
        $pagination = GetPage($total_count,$limit,$p,'ajax_page');

        $data['keywords'] = '';
        $data['description'] = '';
        $data['pagination'] = $pagination;
        $data['curr'] = $curr;
        $data['list'] = $list;
        return $data;
    }


    public function access(){
        $ip = get_real_ip();
        if(in_array($ip , array('180.168.183.186'))) return 'admin';
        $url = $_REQUEST['url'];
        $ip_address = get_ip_local($ip);
        $iscrawler = isCrawler();
        $data = array('url'=>$url,'ip'=>$ip,'ip_address'=>$ip_address,'is_crawler'=>$iscrawler,'create_time'=>date('Y-m-d H:i:s'));
        Access::insert($data);
        return 'success';
    }

}
