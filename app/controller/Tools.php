<?php


namespace app\controller;
use app\BaseController;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\Template;

class Tools extends BaseController //管理员操作数据库工具类
{
    public function student_list(){
        if(!Session::has('name'))
            return redirect('/');
        $message="";
        $choose=Request::has('choose','get') ? Request::get('choose') : "";
        if($choose){
            $message=Request::get('message');
            Session::set('message',$message);
            Session::set('choose',$choose);
        }else{/*利用session来避免查找无法分页问题*/
            if(!Request::has('id','get')){
                if(Session::has('message')){
                    Session::delete('message');
                    Session::delete('choose');
                }
            }else{
                if(Session::has('message')){
                    $message=Session::get('message');
                    $choose=Session::get('choose');
                }
            }
        }
        //获取请求的id
        $id=Request::has('id','get') ? Request::get('id') : 0;
        //这里根据要求来查询数据
        switch ($choose){ //根据查询选项来寻找
            case "sno":
                $num=Db::table('student')->where('sid',$message)->count();
                $list = Db::query("select * from student WHERE sid=".$message." ORDER BY sid ASC LIMIT ".($id*10).",10;");
                //增加密码字段，因为密码存在用户表，学生信息存在学生表
                foreach ($list as $key=>$value){
                    $pwd=Db::table('users')->where('uid',$value['sid'])->value('password');
                    $list[$key]['pwd']=$pwd;
                }
                break;
            case "name":
                $num=Db::table('student')->where('name',$message)->count();
                $list = Db::query("select * from student WHERE name='".$message."' ORDER BY sid  ASC LIMIT ".($id*10).",10;");
                //增加密码字段，因为密码存在用户表，学生信息存在学生表
                foreach ($list as $key=>$value){
                    $pwd=Db::table('users')->where('uid',$value['sid'])->value('password');
                    $list[$key]['pwd']=$pwd;
                }
                break;
            default: //默认显示全部
                $num=Db::table('student')->count('sid');
                $list = Db::query("select * from student ORDER BY sid ASC LIMIT ".($id*10).",10;");
                //增加密码字段，因为密码存在用户表，学生信息存在学生表
                foreach ($list as $key=>$value){
                    $pwd=Db::table('users')->where('uid',$value['sid'])->value('password');
                    $list[$key]['pwd']=$pwd;
                    //更新班级名称
                    $list[$key]['cname']=Db::table('class')->where('cno',$value['cno'])->value('name');
                }
                break;
        }
        //分页数
        $page=ceil($num/10);  //向上舍入最为接近的整数
        //显示信息
        $template = new Template();
        return $template ->fetch('../view/root/student-list',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id]);
    }
    public function teacher_list(){
        if(!Session::has('name'))
            return redirect('/');
        $list=Db::table('student')->order('sid', 'asc')->paginate(8);
        // 获取分页显示
        $page = $list->render();
        return view('/root/teacher-list', ['list' => $list, 'page' => $page]);
    }
    public function student_edit(){
        $data=Request::post();
        $result1=Db::table('users')->where('uid',$data['sid'])->update(['password'=>$data['pwd']]);
        $data2=[];
        foreach ($data as $key=>$value){
            if ($key !== 'pwd')
                $data2[$key]=$value;
        }
        $result2=Db::table('student')->where('sid',$data['sid'])->update($data2);
        if($result1 || $result2)
            return 'ok';
        else
            return 'err';
    }
    public function student_add(){
        $data=Request::post();
        //先在用户表插入一个默认密码123456的，type2的用户，然后getID再进行update
        $uid=Db::table('users')->insertGetId(['password'=>'123456','type'=>'2']);
        $data['sid']=$uid;
        $result=Db::table('student')->save($data);
        if($result){
            return 'ok';
        }else{
            return 'err';
        }
    }
    public function del(){
        if(Request::has('id','get')){//获取请求的id
            $id= Request::get('id');
            if(DB::table('users')->delete($id))
                return 'ok';
            else
                return 'err';
        }
    }
    public function mdel(){ /*批量删除学生*/
//        $data=Request::post();
//        $ids=explode(",",$data['ids']);
//        Db::startTrans();
//        try{
//            DB::table('users')->delete($ids);
//            DB::commit();
//        }catch (\Exception $e){
//            DB:rollback();
//            return 'err';
//        }
        return 'ok';
        //var_dump($ids);
    }
    public function class_list(){
        if(!Session::has('name'))
            return redirect('/');
        $message="";
        $choose=Request::has('choose','get') ? Request::get('choose') : "";
        if($choose){
            $message=Request::get('message');
            Session::set('message',$message);
            Session::set('choose',$choose);
        }else{/*利用session来避免查找无法分页问题*/
            if(!Request::has('id','get')){
                if(Session::has('message')){
                    Session::delete('message');
                    Session::delete('choose');
                }
            }else{
                if(Session::has('message')){
                    $message=Session::get('message');
                    $choose=Session::get('choose');
                }
            }
        }
        //获取请求的id
        $id=Request::has('id','get') ? Request::get('id') : 0;
        //这里根据要求来查询数据
        switch ($choose){ //根据查询选项来寻找
            case "cno":
                $num=Db::table('class')->where('cno',$message)->count();
                $list = Db::query("select * from class WHERE cno=".$message." ORDER BY cno ASC LIMIT ".($id*10).",10;");
                break;
            case "name":
                $num=Db::table('class')->where('name',$message)->count();
                $list = Db::query("select * from class WHERE name='".$message."' ORDER BY name  ASC LIMIT ".($id*10).",10;");
                break;
            default: //默认显示全部
                $num=Db::table('class')->count('cno');
                $list = Db::query("select * from class ORDER BY cno ASC LIMIT ".($id*10).",10;");
                break;
        }
        $page=ceil($num/10);
        $template = new Template();
        return $template ->fetch('../view/root/class-list',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id]);
    }

}