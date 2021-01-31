<?php /*a:1:{s:21:"../view/register.html";i:1611714856;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>英语学习与测试平台</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="reg-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">英语学习与测试平台注册页面</div>
    <div id="darkbannerwrap"></div>
    <form method="post" class="layui-form" >
        <input name="uid" lay-verify="userne" placeholder="用户名"  type="text" class="layui-input" >
        <hr class="hr15">
        <input id="pwd" name="password" lay-verify="passwd" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr20">
        <input  lay-verify="passwd2" placeholder="重复密码"  type="password" class="layui-input">
        <hr class="hr20">
        <input value="提交" lay-submit lay-filter="register" style="width:100%;" type="submit"/>
        <hr class="hr15">
    </form>
    <button class="layui-btn layui-btn-lg" style="width:100%;" onclick="window.location='/'"/>返回</button>
    <hr class="hr20" >
</div>

<script>
    layui.use('form', function(){
        var form = layui.form;
        //自定义验证规则
        form.verify({
            userne:function (value) {
                if(value.length===0){
                    return '请输入用户名!';
                }
            },
            passwd: function(value) {
                if (value.length===0) {
                    return '请输入密码!';
                }
            },
            passwd2: function(value) {
                // if($('input[name=password]').val() !== value)
                if($('#pwd').val() !== value)
                    return '两次密码输入不一致！';
            },
        });
        //监听提交
        form.on('submit(register)', function(data){
            $.ajax({
                type:"post",
                url:"/Index/register",
                sync:false,
                data:{
                    uid:data.field.uid,
                    password:data.field.password,
                },
                success:function (msg) {
                    if(msg==='ok'){
                        layer.msg('注册成功!',{icon:6,time:1000},function() {
                            location.href = "<?php echo url('/'); ?>";
                        });
                    }else{
                        layer.alert(msg,{icon: 5})
                    }
                },
                error:function (msg) {
                    layer.alert('未知错误！',{icon: 5})
                }
            });
            return false;
        });
    });
</script>
</body>
</html>