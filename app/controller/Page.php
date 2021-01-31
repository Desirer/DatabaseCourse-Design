<?php


namespace app\controller;
use app\BaseController;
use think\db\Fetch;
use think\facade\Session;
use think\facade\Db;
use think\facade\Request;
use think\Template;

class Page extends BaseController //页面工具类
{
    public function welcome()
    {
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $time=date("Y-m-d H:i");
        return $template ->fetch('../view/welcome',['name'=>Session::get('name'),'time'=>$time]);
    }
    public function join_class(){
        if (!Session::has('name'))
            return redirect('/');
        $data=Db::table('student')->where('sid',Session::get('id'))->find();
        if(is_null($data['cno'])){
            $template = new \think\Template();
            $class =Db::table('class')->select();
            return $template->fetch('../view/student/join-class',['class'=>$class]);
        }else{
            return 'wrong';
        }
    }
    public function article_list(){
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
        $id=Request::has('id','get') ? Request::get('id') : 0;
        switch ($choose){
            case "ano":
                $num=Db::table('article')->where('ano',$message)->count();
                $list = Db::query("select * from article WHERE ano=".$message." ORDER BY ano ASC LIMIT ".($id*10).",10;");
                break;
            case "head":
                $num=Db::table('article')->where('head',$message)->count();
                $list = Db::query("select * from article WHERE head='".$message."' ORDER BY ano  ASC LIMIT ".($id*10).",10;");
                break;
            default: //默认显示全部
                $num=Db::table('article')->count('ano');
                $list = Db::query("select * from article ORDER BY ano ASC LIMIT ".($id*10).",10;");
                break;
        }
        foreach ($list as $key=>$value){ //更新教师名称
            $list[$key]['tname']=Db::table('teacher')->where('tid',$value['tid'])->value('name');
        }
        $page=ceil($num/10);
        $template = new Template();
        return $template ->fetch('../view/article-list',['list'=>$list,'page'=>$page,'num'=>$num,'id'=>$id]);
    }
    public function article_content(){//展示文章内容
        $ano=Request::get('ano');
        $data=Db::table('article')->where('ano',$ano)->find();
        $template = new \think\Template();
        return $template->fetch('../view/article-content',['data'=>$data]);
    }
    public function student_add()
    {
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        //查询所有的班级
        $class = Db::table('class')->select();
        return $template ->fetch('../view/root/student-add',['class'=>$class]);
    }
    public function student_edit()
    {
        if(!Session::has('name'))
            return redirect('/');
        //获取请求的id
        $sid=Request::has('sid','get') ? Request::get('sid') : 0;
        $template = new \think\Template();
        $result=Db::table('student')->where('sid',$sid)->find();
        $class = Db::table('class')->select();
        $pwd =Db::table('users')->where('uid',$sid)->value('password');
        return $template ->fetch('../view/root/student-edit',['class'=>$class,'data'=>$result,'pwd'=>$pwd,'sid'=>$sid]);
    }
    public function exam_add(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $class =Db::table('class')->select();
        return $template->fetch('../view/teacher/exam-add',['class'=>$class]);
    }
    public function exam_edit(){
        if(!Session::has('name'))
            return redirect('/');
        $eid=Request::get('eid');
        $data=Db::table('exam')->where('eid',$eid)->find();
        $template = new \think\Template();
        $class =Db::table('class')->select();
        return $template->fetch('../view/teacher/exam-edit',['class'=>$class,'data'=>$data]);
    }
    public function problem_add()
    {
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $eid=Request::get('eid');
        return $template ->fetch('../view/teacher/problem-add',['eid'=>$eid]);
    }
    public function writing_add()
    {
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $eid=Request::get('eid');
        return $template ->fetch('../view/teacher/writing-add',['eid'=>$eid]);
    }
    public function listening_add()
    {
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $eid=Request::get('eid');
        return $template ->fetch('../view/teacher/listening-add',['eid'=>$eid]);
    }
    public function exam_content(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $eid=Request::get('eid');
        $lid=Db::table('listening')->where('eid',$eid)->value('lid');
        $rid=Db::table('reading')->where('eid',$eid)->value('rid');
        $write=Db::table('writing')->where('eid',$eid)->find();
        $listen=Db::table('problem')->where('lid',$lid)->find();//这里并没有出错
        $url=Db::table('listening')->where('lid',$lid)->value('audiourl');
        $read=Db::table('problem')->where('rid',$rid)->find();
        $select=['num'=>3,'total_points'=>'100'];
        $select['total_points']=$write['value']+$listen['value']+$read['value'];
        return $template->fetch('../view/teacher/exam-content',['select'=>$select,'listen'=>$listen,'read'=>$read,'write'=>$write,'url'=>$url]);
    }
    public function exam_start(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $eid=Request::get('eid');
        $lid=Db::table('listening')->where('eid',$eid)->value('lid');
        $rid=Db::table('reading')->where('eid',$eid)->value('rid');
        $write=Db::table('writing')->where('eid',$eid)->find();
        $listen=Db::table('problem')->where('lid',$lid)->find();
        $url=Db::table('listening')->where('lid',$lid)->value('audiourl');
        $read=Db::table('problem')->where('rid',$rid)->find();
        $select=['num'=>3,'total_points'=>'100'];
        $select['total_points']=$write['value']+$listen['value']+$read['value'];
        return $template->fetch('../view/student/exam-content',['select'=>$select,'listen'=>$listen,'read'=>$read,'write'=>$write,'eid'=>$eid,'url'=>$url]);
    }
    public function exam_student_list(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $cno=Request::get('cno');
        $eid=Request::get('eid');
        $exam_name=Db::table('exam')->where('eid',$eid)->value('name');
        $list=Db::table('student')
            ->alias('s')
            ->where('cno',$cno)
            ->join('answrite w','s.sid=w.sid')
            ->where('eid',$eid)
            ->field('w.sid,name,score,status')
            ->select();
        return $template->fetch('../view/teacher/writing-list',['eid'=>$eid,'ename'=>$exam_name,'list'=>$list]);
    }
    public function write_review(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $sid=Request::get('sid');
        $eid=Request::get('eid');
        $data=Db::table('answrite')->where(['sid'=>$sid,'eid'=>$eid])->find();
        return $template->fetch('../view/teacher/writing-review',['data'=>$data]);
    }
    public function info(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $type=Session::get('type');
        if($type==1){
            $data=Db::table('teacher')->where('tid',Session::get('id'))->find();
            $data['no']=$data['tno'];
        }
        else{
            $data=Db::table('student')->where('sid',Session::get('id'))->find();
            $data['no']=$data['sno'];
        }
        $data['id']=Session::get('id');
        return $template->fetch('../view/info',['data'=>$data,'type'=>$type]);
    }
    public function info_save(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $type=Session::get('type');
        if($type==1){
            $data['tid']=$data['id'];
            $data['tno']=$data['no'];
            $result=Db::table('teacher')->strict(false)->save($data);
        }
        else{
            $data['sid']=$data['id'];
            $data['sno']=$data['no'];
            $result=Db::table('student')->strict(false)->save($data);
        }
        if($result){
            Session::set('name',$data['name']);
            return 'ok';
        } else{
            return 'error';
        }
    }
    public function pwd(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        return $template->fetch('../view/pwd');
    }
    public function pwd_save(){
        if(!Session::has('name'))
            return redirect('/');
        $data=Request::post();
        $oldpwd=Db::table('users')->where('uid',Session::get('id'))->value('password');
        if($oldpwd==$data['pwd']){
            $result=DB::name('users')->where('uid',Session::get('id'))->update(['password'=>$data['newpwd']]);
            if($result)
                return 'ok';
            else
                return 'error';
        }else{
            return '原密码错误';
        }
    }
    public function article_add(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        return $template->fetch('../view/teacher/article-add');
    }
    public function class_add(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        return $template->fetch('../view/teacher/class-add');
    }
    public function class_edit(){
        if(!Session::has('name'))
            return redirect('/');
        $template = new \think\Template();
        $cno=Request::get('cno');
        return $template->fetch('../view/teacher/class-edit',['cno'=>$cno]);
    }
    public function exam_score_list(){
        if(!Session::has('name'))
            return redirect('/');
        $tid=Session::get('id');
        $eid_list=Db::table('exam')->where('tid',$tid)->column('eid,name');
        $eid=Request::has('eid','get')? Request::get('eid') :$eid_list[0]['eid'];
        $cno=Db::table('exam')->where('eid',$eid)->value('cno');
        $sid_list=Db::table('student')->where('cno',$cno)->field('sid,sno,name')->select()->toArray();
        foreach ($sid_list as $key=>$value){ //为每个sid添加成绩
            $grade=Db::table('answer')->where('sid',$value['sid'])->sum('score');
            $score=Db::table('answrite')->where('sid',$value['sid'])->value('score');
            $sid_list[$key]['grade']=$grade;
            $sid_list[$key]['score']=$score;
        }
        $template = new \think\Template();
        return $template->fetch('../view/teacher/exam-score-list',['elist'=>$eid_list,'list'=>$sid_list]);
    }
}