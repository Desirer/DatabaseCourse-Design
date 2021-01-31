<?php
namespace app\controller;
use app\BaseController;
use think\facade\Db;
use think\facade\Request;
use think\Template;
use think\facade\Session;

class Index extends BaseController //基础操作，登录注册,以及文件上传
{
    public function index(){ //初始方法
        $template = new \think\Template();
        if(Session::has('name')){  //通过判断用户类型，从而登录不同的后台页面
            if(Session::get('type')==0) //管理员
                return $template ->fetch('../view/root/index');
            elseif (Session::get('type')==1)//教师
                return $template ->fetch('../view/teacher/index1',['name'=>Session::get('name'),'tid'=>Session::get('id')]);
            else                                //学生
                return $template ->fetch('../view/student/index2',['name'=>Session::get('name'),'sid'=>Session::get('id')]);
        }
        else
            return $template ->fetch('../view/login');
    }
    public function login(){    //登录验证
        $data=Request::post();
        $list=Db::table('users')->where('uid',$data['uid'])->find();
        if($list){
            //if(md5($data['password'])==$list['passwd']){ //md5加密
            if($data['password']==$list['password']){
                Session::set('id',$list['uid']);  //session回话，保持用户登录
                Session::set('type',$list['type']);
                if($list['type']==2){
                    $name=Db::table('student')->where('sid',$data['uid'])->value('name');
                    Session::set('name',$name);
                }else{
                    $name=Db::table('teacher')->where('tid',$data['uid'])->value('name');
                    Session::set('name',$name);
                }
                return 'ok';
            }else
                return '密码错误！';
        }else{
            return '用户名不存在！';
        }
    }
    public function getreg(){//去往注册页面
        $template = new \think\Template();
        return $template ->fetch('../view/register');
    }
    public function register(){//注册一个新用户，默认只能注册学生
        $data=Request::post();
        $list=Db::table('users')->where('uid',$data['uid'])->find();
        if($list)
            return '用户名已存在！';
        else{
            $data2=['uid' => $data['uid'],'password'=>$data['password'],'type'=>2];
            Db::table('users')->insert($data2);
            return 'ok';
        }
    }
    public function logout(){
        Session::delete('name');
        return redirect('/');
    }
}
