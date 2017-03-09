<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use App\Model\Article;
use App\Model\Base;
use App\Model\Fitment;
use App\Model\Image;
use App\Model\Retrofit;
use App\Model\Floor;
use App\Model\Bespeak;
use App\Model\Access;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    const banner_type = 0;   //轮播
    const style_type = 1;  //风格
    const house_type = 2;  //户型
    const space_type = 3;  //空间
    private $bespeak_type = array(0=>'已预约',1=>'施工中',2=>'已完成',3=>'无效');

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
        if($password !== '36f17c3939ac3e7b2fc9396fa8e953ea') splash('error','密码错误');

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

    public function floor(){
        $data['curr'] = 'floor';
        return view('admin.floor')->with('data', $data);
    }

    public function event(){
        $data['curr'] = 'event';
        return view('admin.event')->with('data', $data);
    }

    public function bespeak(){
        $data['curr'] = 'bespeak';
        return view('admin.bespeak')->with('data', $data);
    }

    public function access(){
        $data['curr'] = 'access';
        return view('admin.access')->with('data', $data);
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
                elseif($v['type'] == self::space_type) $v['type'] = '空间';
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
            $space_res = Base::select('name','sign_id')->where('type', self::space_type)->get()->toArray();
            $space_list = array_column($space_res,'name','sign_id');

            $data['total'] = Retrofit::count();
            $data['rows'] = Retrofit::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=retrofit&id='.$v['rec_id'].'">编辑</a>';
                $v['type'] = empty($space_list[$v['type']]) ? '其他' : $space_list[$v['type']];
            }
        }elseif($t == 'floor'){
            $data['total'] = Floor::count();
            $data['rows'] = Floor::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=floor&id='.$v['rec_id'].'">编辑</a>';
                $v['type'] = empty($v['type']) ? '普通地板' : '自热地板';
            }
        }elseif($t == 'event'){
            $data['total'] = Article::count();
            $data['rows'] = Article::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as &$v){
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=event&id='.$v['rec_id'].'">编辑</a>';
                if($v['type'] == 1) $v['type'] = '活动';
                elseif($v['type'] == 2) $v['type'] = '资讯';
            }
        }elseif($t == 'bespeak'){
            $bespeak_type = $this->bespeak_type;
            $data['total'] = Bespeak::count();
            $data['rows'] = Bespeak::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();

            foreach($data['rows'] as $key=>&$v){
                $v['type'] = empty($bespeak_type[$v['type']]) ? '未知' : $bespeak_type[$v['type']];
                $v['op'] = '<a class="edit-btn" href="/admin/edit?t=bespeak&id='.$v['rec_id'].'">编辑</a>';
            }
        }elseif($t == 'access'){
            $order = 'desc';
            $data['total'] = Access::count();
            $data['rows'] = Access::skip($offset)->take($limit)->orderBy($sort, $order)->get()->toArray();
            foreach($data['rows'] as $key=>&$v){
                $v['is_crawler'] = empty($v['is_crawler']) ? '否' : '是';
            }
        }
        echo json_encode($data);
    }

    public function edit(){
        $t = $_REQUEST['t'];
        $id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);

        $base_res = Base::select('name','sign_id','type')->whereIn('type', array(self::style_type ,self::house_type,self::space_type))->orderBy('sort', 'desc')->get()->toArray();
        $house_list = $style_list = $space_list = array();
        foreach($base_res as $row){
            if($row['type'] == self::style_type) $style_list[$row['sign_id']] = $row['name'];
            elseif($row['type'] == self::house_type ) $house_list[$row['sign_id']] = $row['name'];
            elseif($row['type'] == self::space_type ) $space_list[$row['sign_id']] = $row['name'];
        }

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
        }elseif($t == 'floor') {
            $space_list = array(0=>'普通地板',1=>'自热地板');
            if($id) $result = Floor::where("rec_id",$id)->first();
            else $result = array('rec_id'=>0,'name'=>'','type'=>'0','img_url'=>'');
        }elseif($t == 'event'){
            if($id) $result = Article::where("rec_id",$id)->first();
            else $result = array('rec_id'=>0,'title'=>'','type'=>0,'sort'=>0,'title_img'=>'','keywords'=>'','description'=>'','create_time'=>date('Y-m-d H:i:s'),'content'=>'');
        }elseif($t == 'bespeak'){
            if($id) $result = Bespeak::where("rec_id",$id)->first();
            else $result = array('rec_id'=>0,'name'=>'','type'=>0,'mobile'=>'','address'=>'','remark'=>'','keep_time'=>'','create_time'=>date('Y-m-d H:i:s'),'year'=>0);
        }else{
            return view('errors.503');
        }

        $data = array('curr'=>$t,'style_list'=>$style_list,'house_list'=>$house_list,'type_list'=>$space_list,'bespeak_type'=>$this->bespeak_type);
        return view('admin.'.$t.'_edit')->with(['data'=>$data,'info'=>$result]);
    }

    public function delete(){
        $t = $_REQUEST['t'];
        $ids = trim($_REQUEST['ids']);
        if(empty($ids)) splash('error','参数有误');
        $ids = explode(',',$ids);

        if($t == 'base') $res = Base::whereIn('rec_id',$ids)->delete();
        elseif($t == 'fitment') $res = Fitment::whereIn('rec_id', $ids)->delete();
        elseif($t == 'retrofit') $res = Retrofit::whereIn('rec_id', $ids)->delete();
        elseif($t == 'floor') $res = Floor::whereIn('rec_id', $ids)->delete();
        elseif($t == 'event') $res = Article::whereIn('rec_id', $ids)->delete();
        elseif($t == 'bespeak') $res = Bespeak::whereIn('rec_id', $ids)->delete();
        elseif($t == 'access') $res = Access::whereIn('rec_id', $ids)->delete();
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
            $data['url'] = empty($_REQUEST['url']) ? '' : trim($_REQUEST['url']);
            $data['img_url'] = empty($_REQUEST['img_url']) ? '' : trim($_REQUEST['img_url']);
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
        }elseif($t == 'floor') {
            $data['name'] = trim($_REQUEST['name']);
            $data['type'] = trim($_REQUEST['type']);
            $data['img_url'] = trim($_REQUEST['img_url']);
            if(empty($id)) $res = $id = Floor::insertGetId($data);
            else $res = Floor::where('rec_id', $id)->update($data);
        }elseif($t == 'event'){
            $data['title'] = trim($_REQUEST['title']);
            $data['type'] = intval($_REQUEST['type']);
            $data['sort'] = intval($_REQUEST['sort']);
            $data['keywords'] = trim($_REQUEST['keywords']);
            $data['description'] = trim($_REQUEST['description']);
            $data['create_time'] = trim($_REQUEST['create_time']);
            $data['content'] = trim($_REQUEST['content']);
            $data['title_img'] = trim($_REQUEST['title_img']);
            if(empty($id)) $res = $id = Article::insertGetId($data);
            else $res = Article::where('rec_id', $id)->update($data);
        }elseif($t == 'bespeak'){
            $data['name'] = $name = trim($_POST['name']);
            $data['mobile'] = $mobile = trim($_POST['mobile']);
            $data['address'] = $address = trim($_POST['address']);
            $data['remark'] = $remark = trim($_POST['remark']);
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['type'] = empty($_POST['type']) ? 0 : $_POST['type'];
            if($data['type'] == 2){
                $data['year'] = empty($_POST['year']) ? 1 : intval($_POST['year']);
                $data['keep_time'] = date('Y.m.d').'-'.date('Y.m.d',strtotime('+'.$data['year'].' year'));
            }

            if(empty($name) || empty($mobile) || empty($address)) splash('error','请填写完整信息');
            if(!preg_match("/^1[345789]{1}\d{9}$/",$mobile)) splash('error','请输入正确手机号');
            if(empty($id)) $res = $id = Bespeak::insertGetId($data);
            else $res = Bespeak::where('rec_id', $id)->update($data);
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
                    Image::where('img_id', $row[0])->update(array('img_url'=>$row[1],'sort'=>$row[2]));
                }elseif(($row[1] != $old_img_list[$row[0]]['img_url']) && ($row[2] == $old_img_list[$row[0]]['sort'])){
                    Image::where('img_id', $row[0])->update(array('img_url'=>$row[1]));
                }elseif(($row[1] == $old_img_list[$row[0]]['img_url']) && ($row[2] != $old_img_list[$row[0]]['sort'])){
                    Image::where('img_id', $row[0])->update(array('sort'=>$row[2]));
                }
            }
        }

        $diff_ids = array_diff($old_img_ids,$new_img_ids);
        if(!empty($diff_ids))   Image::whereIn('img_id', $diff_ids)->delete();

    }

}
