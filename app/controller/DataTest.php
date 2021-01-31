<?php


namespace app\controller;
use think\facade\Request;
use think\facade\Db;

class DataTest
{
    public function index(){
          return 'odsaak';
    }
    public function testing(){
        $data=Request::post();

        return 'ok';
    }
    public function upload(){
        $file = request()->file('file');
        try{
            validate(['audioFile' => [
                'fileSize' =>50*1024*1024,
                'fileExt'  => array('mp3','wav'),
                ]])->check(['audioFile'=>$file]);
            $saveName = \think\facade\Filesystem::disk('public')->putFile( 'music', $file);
            $arr = ['status' => 200, 'msg' => '成功', 'path' => '/storage/'.$saveName];
            return json($arr);
        }catch (\Exception $e) {
            return $this->exceptionHandle($e,'上传失败!' . $e->getMessage(),'json','');
        }
    }
}