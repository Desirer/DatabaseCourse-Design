<?php


namespace app\controller;
use app\BaseController;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\Template;


class Ttools //教师管理工具类
{
    public function class_list(){  //教师只能查看自己的班级
        if(!Session::has('name'))
            return redirect('/');
        $id=Request::has('id','get') ? Request::get('id') : 0;
        $tid=Session::get('id');
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
                $list = Db::query("select * from class WHERE tid=".$tid." ORDER BY cno ASC LIMIT ".($id*10).",10;");
                break;
        }
        $tname=Session::get('name');
        $page=ceil($num/10);
        $template = new Template();
        return $template ->fetch('../view/teacher/class-list',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id,'tname'=>$tname]);
    }
    public function class_delete(){
        if(!Session::has('name'))
            return redirect('/');
        $cno=Request::get('cno');
        $result=Db::table('class')->where('cno',$cno)->delete();
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function class_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $data['tid']=Session::get('id');
        $result=Db::table('class')->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function class_edit(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $data['tid']=Session::get('id');
        $result=Db::table('class')->save($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function exam_list(){
        if(!Session::has('name'))
            return redirect('/');
        $id=Request::has('id','get') ? Request::get('id') : 0;
        $tid=Session::get('id');
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
        switch ($choose){
            case "eid":
                $num=Db::table('exam')->where('eid',$message)->count();
                $list = Db::query("select * from exam WHERE eid=".$message." ORDER BY eid ASC LIMIT ".($id*10).",10;");
                break;
            default: //默认显示全部
                $num=Db::table('exam')->count('eid');
                $list = Db::query("select * from exam WHERE tid=".$tid." ORDER BY eid ASC LIMIT ".($id*10).",10;");
                break;
        }
        foreach ($list as $key=>$value){ //更新班级名称
            $list[$key]['cname']=Db::table('class')->where('cno',$value['cno'])->value('name');
        }
        $page=ceil($num/10);
        $template = new Template();
        $tname=Session::get('name');
        return $template ->fetch('../view/teacher/exam-list',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id,'tname'=>$tname]);
    }
    public function exam_list2(){
        if(!Session::has('name'))
            return redirect('/');
        $id=Request::has('id','get') ? Request::get('id') : 0;
        $tid=Session::get('id');
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
        switch ($choose){
            case "eid":
                $num=Db::table('exam')->where('eid',$message)->count();
                $list = Db::query("select * from exam WHERE eid=".$message." ORDER BY eid ASC LIMIT ".($id*10).",10;");
                break;
            default: //默认显示全部
                $num=Db::table('exam')->count('eid');
                $list = Db::query("select * from exam WHERE tid=".$tid." ORDER BY eid ASC LIMIT ".($id*10).",10;");
                break;
        }
        foreach ($list as $key=>$value){ //更新班级名称
            $list[$key]['cname']=Db::table('class')->where('cno',$value['cno'])->value('name');
        }
        $page=ceil($num/10);
        $template = new Template();
        $tname=Session::get('name');
        return $template ->fetch('../view/teacher/exam-list2',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id,'tname'=>$tname]);
    }
    public function exam_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $data['tid']=Session::get('id');
        $result=Db::table('exam')->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function exam_edit(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $data['tid']=Session::get('id');
        $result=Db::table('exam')->save($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function exam_del(){
        if(!Session::has('name'))
            return redirect('/');
        $eid=Request::get('eid');
        $result=Db::table('exam')->where('eid',$eid)->delete();
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function problem_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $rid=Db::table('reading')->insertGetId(['material'=>$data['material'],'eid'=>$data['eid']]);
        $data['rid']=$rid;
        $result=Db::table('problem')->strict(false)->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function writing_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $result=Db::table('writing')->strict(false)->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function listening_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $lid=Db::table('listening')->insertGetId(['audiourl'=>$data['audiourl'],'eid'=>$data['eid']]);
        $data['lid']=$lid;
        $result=Db::table('problem')->strict(false)->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function write_review(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $result=Db::table('answrite')->strict(false)->save($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function article_add(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $data['tid']=Session::get('id');
        $result=Db::table('article')->insert($data);
        if($result)
            return 'ok';
        else
            return 'error';
    }
}
