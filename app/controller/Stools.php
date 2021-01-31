<?php


namespace app\controller;


use app\BaseController;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\Template;

class Stools extends BaseController   //学生管理工具类
{
    public function join_class(){
        if (!Session::has('name'))
            return redirect('/');
        $cno=Request::post('cno');
        $result=Db::table('student')->where('sid',Session::get('id'))->update(['cno'=>$cno]);
        if($result)
            return 'ok';
        else
            return 'error';
    }
    public function exam_list()
    {
        if (!Session::has('name'))
            return redirect('/');
        $id = Request::has('id', 'get') ? Request::get('id') : 0;
        $sid = Session::get('id');
        $message = "";
        $choose = Request::has('choose', 'get') ? Request::get('choose') : "";
        if ($choose) {
            $message = Request::get('message');
            Session::set('message', $message);
            Session::set('choose', $choose);
        } else {/*利用session来避免查找无法分页问题*/
            if (!Request::has('id', 'get')) {
                if (Session::has('message')) {
                    Session::delete('message');
                    Session::delete('choose');
                }
            } else {
                if (Session::has('message')) {
                    $message = Session::get('message');
                    $choose = Session::get('choose');
                }
            }
        }
        $cno=Db::table('student')->where('sid',$sid)->value('cno');
        switch ($choose) {
            case "eid":
                $num = Db::table('exam')->where('eid', $message)->count();
                $list = Db::query("select * from exam WHERE eid=" . $message . " and cno =" . $cno . " ORDER BY eid ASC LIMIT " . ($id * 10) . ",10;");
                break;
            case "tid":
                $num = Db::table('exam')->where('tid', $message)->count();
                $list = Db::query("select * from exam WHERE tid=" . $message . " and cno =" . $cno . " ORDER BY eid  ASC LIMIT " . ($id * 10) . ",10;");
                break;
            default: //默认显示全部
                $num = Db::table('exam')->count('eid');
                $list = Db::query("select * from exam WHERE cno=" . $cno . " ORDER BY eid ASC LIMIT " . ($id * 10) . ",10;");
                break;
        }
        foreach ($list as $key=>$value){
            $list[$key]['tname']=Db::table('teacher')->where('tid',$value['tid'])->value('name');
        }
        $page = ceil($num / 10);
        $template = new Template();
        return $template->fetch('../view/student/exam-list', ['list' => $list, 'page' => $page, 'num' => $num, 'id' => $id]);
    }
    public function exam_submit(){
        if (!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $eid=$data['eid'];
        $sid=Session::get('id');
        unset($data['eid']);   //去除data的eid字段
        $content=$data['write'];
        unset($data['write']);
//        dump($data);
//        dump($content);
        foreach ($data as $key=>$value){
            $temp=['eid'=>$eid,'pid'=>$key,'sid'=>$sid,'answer'=>$value];
            Db::table('answer')->insert($temp);
        }
        $wid=Db::table('writing')->where('eid',$eid)->value('wid');
        $temp2=['eid'=>$eid,'sid'=>$sid,'wid'=>$wid,'content'=>$content,'status'=>0];
        Db::table('answrite')->insert($temp2);
        return redirect('/');
    }
    public function grade_list(){
        if (!Session::has('name'))
            return redirect('/');
        $sid=Session::get('id');
        $data=Db::table('answer')
            ->field('eid,sid,sum(score) grade')
            ->where('sid',$sid)
            ->group('eid,sid')
            ->select()->toArray();
        foreach ($data as $key=>$value){ //增加考试名字
            $data[$key]['name']=Db::table('exam')->where('eid',$value['eid'])->value('name');
            $temp=Db::table('answrite')->where(['eid'=>$value['eid'],'sid'=>$sid])->find();
            $data[$key]['status']=$temp['status'];
            $data[$key]['score']=$temp['score'];
        }
        $template = new Template();
        return $template->fetch('../view/student/grade-list',['list'=>$data]);
    }
    public function classmate_list(){
        if (!Session::has('name'))
            return redirect('/');
        $cno=Db::table('student')->where('sid',Session::get('id'))->value('cno');
        $cname=Db::table('class')->where('cno',$cno)->value('name');
        $data=Db::table('student')->where('cno',$cno)->select();
        $template = new Template();
        return $template->fetch('../view/student/classmate-list',['list'=>$data,'cno'=>$cno,'cname'=>$cname]);
    }

}