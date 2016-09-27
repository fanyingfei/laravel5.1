<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Model\Article;
use App\Model\Base;
use Session;
use Cookie;
use App\Model\Fitment;
use App\Model\Image;
use App\Model\Retrofit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    const banner_type = 0;   //轮播
    const style_type = 1;  //风格
    const house_type = 2;  //户型
    private $type_list = array('wall'=>'墙面','room'=>'客厅','bathroom'=>'卫生间','kitchen'=>'厨房','other'=>'其他');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){
        return view('admin.login');
    }

    public function sign_in(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username) || empty($password)) splash('error','请输入用户名和密码');
        if($username !== 'fanfan') splash('error','用户名错误');
        if($password !== 'f53bafd8c2b602abca59e4c2854440d8') splash('error','密码错误');

        Session::put('admin', 'fanfan');
        Session::save();

        $config = config('session');

    //    $response = new Response();
    //    $response->headers->setCookie( new Cookie( 'fffff', 'sdfadsf', time() + 60 * 120,  $config['path'], $config['domain'], $config['secure'], false ) );

        splash('success','登陆成功');
    }

    public function base(){
        $data['curr'] = 'base';
        return view('admin.base')->with('data', $data);
    }

    public function fitment(){
        $data['curr'] = 'fitment';
        return view('admin.fitment')->with('data', $data);
    }

    public function retrofit(){
        $data['curr'] = 'retrofit';
        return view('admin.retrofit')->with('data', $data);
    }

    public function event(){
        $data['curr'] = 'event';
        return view('admin.event')->with('data', $data);
    }

    public function data_list(){
        $limit = empty($_REQUEST['limit']) ? 10 : $_REQUEST['limit'];
        $offset = empty($_REQUEST['order']) ? 0 : $_REQUEST['offset'];
        $sort = empty($_REQUEST['sort']) ? 'rec_id' : $_REQUEST['sort'];
        $order = empty($_REQUEST['order']) ? 'asc' : $_REQUEST['order'];

        $t = $_REQUEST['t'];
        if($t == 'base'){
            $data['total'] = Base::count();
            $data['rows'] = Base::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=base&id='.$v['rec_id'].'">编辑</a>';
                if($v['type'] == self::banner_type) $v['type'] = '轮播';
                elseif($v['type'] == self::style_type) $v['type'] = '风格';
                elseif($v['type'] == self::house_type) $v['type'] = '户型';
            }
        }elseif($t == 'fitment'){
            $base_res = Base::select('name','sign_id','type')->whereIn('type', array(self::style_type ,self::house_type))->orderBy('sort', 'desc')->get()->toArray();
            $house_list = $style_list = array();
            foreach($base_res as $row){
                if($row['type'] == self::style_type) $style_list[$row['sign_id']] = $row['name'];
                elseif($row['type'] == self::house_type ) $house_list[$row['sign_id']] = $row['name'];
            }
            $data['total'] = Fitment::count();
            $data['rows'] = Fitment::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=fitment&id='.$v['rec_id'].'">编辑</a>';
                $v['style'] = $style_list[$v['style']];
                $v['house'] = $house_list[$v['house']];
            }
        }elseif($t == 'retrofit'){
            $type_list = $this->type_list;

            $data['total'] = Retrofit::count();
            $data['rows'] = Retrofit::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=retrofit&id='.$v['rec_id'].'">编辑</a>';
                $v['type'] = empty($type_list[$v['type']]) ? '其他' : $type_list[$v['type']];
            }
        }elseif($t == 'event'){
            $data['total'] = Article::count();
            $data['rows'] = Article::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=event&id='.$v['rec_id'].'">编辑</a>';
                if($v['type'] == 1) $v['type'] = '活动';
                elseif($v['type'] == 2) $v['type'] = '资讯';
            }
        }
        echo json_encode($data);
    }

    public function edit(){
        $t = $_REQUEST['t'];
        $id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);

        if($t == 'base'){
            if($id) $result = Base::where("rec_id",$id)->first();
            else return view('errors.503');
        }elseif($t == 'fitment'){
            if($id){
                $result = Fitment::where("rec_id",$id)->first();
                $result['img_list'] = Image::where("rec_id",$id)->orderBy('sort', 'desc')->get()->toArray();
            }else{
                $result = array('rec_id'=>0,'name'=>'','style'=>0,'house'=>0,'area'=>0,'price'=>'','img_list'=>array());
            }
        }elseif($t == 'retrofit'){
            if($id) $result = Retrofit::where("rec_id",$id)->first();
            else $result = array('rec_id'=>0,'title'=>'','type'=>'other','img_url'=>'');
        }elseif($t == 'event'){
            if($id) $result = Article::where("rec_id",$id)->first();
            else $result = array('rec_id'=>0,'title'=>'','type'=>0,'title_img'=>'','keywords'=>'','description'=>'','create_time'=>date('Y-m-d H:i:s'),'content'=>'');
        }else{
            return view('errors.503');
        }

        $base_res = Base::select('name','sign_id','type')->whereIn('type', array(self::style_type ,self::house_type))->orderBy('sort', 'desc')->get()->toArray();
        $house_list = $style_list = array();
        foreach($base_res as $row){
            if($row['type'] == self::style_type) $style_list[$row['sign_id']] = $row['name'];
            elseif($row['type'] == self::house_type ) $house_list[$row['sign_id']] = $row['name'];
        }
        $data = array('curr'=>$t,'style_list'=>$style_list,'house_list'=>$house_list,'type_list'=>$this->type_list);
        return view('admin.'.$t.'_edit')->with(['data'=>$data,'info'=>$result]);
    }

    public function delete(){
        $t = $_REQUEST['t'];
        $ids = trim($_POST['ids']);
        if(empty($ids)) splash('error','参数有误');
        $ids = explode(',',$ids);

        if($t == 'base') $res = Base::whereIn('rec_id',$ids)->delete();
        elseif($t == 'fitment') $res = Fitment::whereIn('rec_id', $ids)->delete();
        elseif($t == 'retrofit') $res = Retrofit::whereIn('rec_id', $ids)->delete();
        elseif($t == 'event') $res = Article::whereIn('rec_id', $ids)->delete();
        else splash('error','参数有误');

        if($res){
            splash('success','删除成功');
        }else{
            splash('error','删除失败,请重试');
        }
    }

    public function save(){
        $t = $_REQUEST['t'];
        $id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);

        if($t == 'base'){
            $data['name'] = trim($_REQUEST['name']);
            $data['sort'] = trim($_REQUEST['sort']);
            if(!empty($_REQUEST['url'])) $data['url'] = trim($_REQUEST['url']);
            if(!empty($_REQUEST['img_url'])) $data['img_url'] = trim($_REQUEST['img_url']);
            if(empty($id)) splash('error','参数有误');
            else $res = Base::where('rec_id', $id)->update($data);
        }elseif($t == 'fitment'){
            $data['name'] = trim($_REQUEST['name']);
            $data['style'] = trim($_REQUEST['style']);
            $data['house'] = trim($_REQUEST['house']);
            $data['area'] = trim($_REQUEST['area']);
            $data['price'] = trim($_REQUEST['price']);
            if(empty($id)) $res = $id = Fitment::insertGetId($data);
            else $res = Fitment::where('rec_id', $id)->update($data);
            $this->save_fitment_img($id);
        }elseif($t == 'retrofit'){
            $data['title'] = trim($_REQUEST['title']);
            $data['type'] = trim($_REQUEST['type']);
            $data['img_url'] = trim($_REQUEST['img_url']);
            if(empty($id)) $res = $id = Retrofit::insertGetId($data);
            else $res = Retrofit::where('rec_id', $id)->update($data);
        }elseif($t == 'event'){
            $data['title'] = trim($_REQUEST['title']);
            $data['type'] = intval($_REQUEST['type']);
            $data['keywords'] = trim($_REQUEST['keywords']);
            $data['description'] = trim($_REQUEST['description']);
            $data['create_time'] = trim($_REQUEST['create_time']);
            $data['content'] = trim($_REQUEST['content']);
            $data['title_img'] = trim($_REQUEST['title_img']);
            if(empty($id)) $res = $id = Article::insertGetId($data);
            else $res = Article::where('rec_id', $id)->update($data);
        }else{
            return view('errors.503');
        }

        if($res){
            splash('success','保存成功',$id);
        }else{
            splash('error','保存失败,请重试');
        }
    }

    public function save_fitment_img($rec_id){
        $new_img_list = $_REQUEST['img_list'];
        $old_img_res = Image::where("rec_id",$rec_id)->orderBy('sort', 'desc')->get()->toArray();
        $old_img_list = $new_img_ids = $old_img_ids = array();

        foreach($old_img_res as $old){
            $old_img_ids[] = $old['img_id'];
            $old_img_list[$old['img_id']] = $old;
        }

        foreach($new_img_list as $row){
            if(empty($row[0])){
                //新增
                Image::insert(array('rec_id'=>$rec_id,'img_url'=>$row[1],'sort'=>$row[2],'create_time'=>date('Y-m-d H:i:s')));
            }else{
                //更新
                $new_img_ids[] = $row[0];
                if(($row[1] != $old_img_list[$row[0]]['img_url']) && ($row[2] != $old_img_list[$row[0]]['sort'])){
                    Image::where('rec_id', $row[0])->update(array('img_url'=>$row[1],'sort'=>$row[2]));
                }elseif(($row[1] != $old_img_list[$row[0]]['img_url']) && ($row[2] == $old_img_list[$row[0]]['sort'])){
                    Image::where('rec_id', $row[0])->update(array('img_url'=>$row[1]));
                }elseif(($row[1] == $old_img_list[$row[0]]['img_url']) && ($row[2] != $old_img_list[$row[0]]['sort'])){
                    Image::where('rec_id', $row[0])->update(array('sort'=>$row[2]));
                }
            }
        }

        $diff_ids = array_diff($old_img_ids,$new_img_ids);
        if(!empty($diff_ids))   Image::whereIn('img_id', $diff_ids)->delete();

    }

}
