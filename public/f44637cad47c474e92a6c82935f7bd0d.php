<?php /*a:1:{s:16:"../view/pwd.html";i:1611714856;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<form class="layui-form" >
    <div class="layui-form-item">
        <label class="layui-form-label">原密码</label>
        <div class="layui-input-inline">
            <input type="password" id="pwd" name="pwd" autocomplete="off" placeholder="请输入原来密码" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">新密码</label>
        <div class="layui-input-inline">
            <input type="password" id="newpwd" name="newpwd" autocomplete="off" placeholder="请输入新密码" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-inline">
            <input type="password" lay-verify="recheck" autocomplete="off" placeholder="请再次输入" class="layui-input">
        </div>
    </div>
    <input type="hidden">
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
<!--            <button  class="layui-btn" lay-submit lay-filter="formDemo">保存</button>-->
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.verify({
            recheck:function (value){
                if($('#newpwd').val()!==value){
                     return '两次密码输入不一致！';
                    }
                else if($('#pwd').val()===value){
                    return '密码未修改！';
                    }
                }
            });
        form.on('submit(formDemo)',function (data){
            $.ajax({
                type:"post",
                url:"/page/pwd_save",
                data:{
                    pwd:data.field.pwd,
                    newpwd:data.field.newpwd,
                },
                success:function (msg) {
                    if(msg==='ok'){
                        layer.msg('修改成功!',{icon:6,time:800},function() {
                            xadmin.close(); //关闭窗口
                        });
                    }else{
                        layer.alert(msg,{icon:5});
                        $("button[type=reset]").trigger("click");
                    }
                },
                error:function (msg) {
                    layer.msg('未知错误！',{icon:5});
                }
            });
            //return false;  //淦，这个return false害我找了半天错，要么button type=button要么return false
        });
    });
</script>

</body>
</html>