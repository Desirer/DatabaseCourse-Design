<?php /*a:1:{s:34:"../view/teacher/listening-add.html";i:1611814626;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>试卷信息</title>
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
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">音频</label>
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="ls" name="audioFile">
                <i class="layui-icon">&#xe67c;</i>上传音频
            </button>
            <input type="hidden" name="audiourl" id="url">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">题干</label>
        <div class="layui-input-block">
            <input type="text" name="content" required  lay-verify="required" placeholder="请输入题干" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分值</label>
        <div class="layui-input-block">
            <input type="text" name="value" required  lay-verify="required" placeholder="请输入分值" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选项A</label>
        <div class="layui-input-block">
            <input type="text" name="a" required  lay-verify="required" placeholder="请输入选项A" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选项B</label>
        <div class="layui-input-block">
            <input type="text" name="b" required  lay-verify="required" placeholder="请输入选项B" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选项C</label>
        <div class="layui-input-block">
            <input type="text" name="c" required  lay-verify="required" placeholder="请输入选项C" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选项D</label>
        <div class="layui-input-block">
            <input type="text" name="d"  placeholder="请输入选项D" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">正确选项</label>
        <div class="layui-input-block">
            <input type="radio" name="bestchoice" value="a" title="A"checked>
            <input type="radio" name="bestchoice" value="b" title="B" >
            <input type="radio" name="bestchoice" value="c" title="C">
            <input type="radio" name="bestchoice" value="d" title="D">
        </div>
    </div>
    <input type="hidden" name="eid" value="<?php echo htmlentities($eid); ?>"><!--  提交考试编号-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use(['upload','form'], function(){
        var upload = layui.upload;
        var form = layui.form;
        upload.render({ //上传
            elem: '#ls',
            url: '/datatest/upload',
            accept:'audio',
            done: function(res){
                if (res.status === 200) {
                    layer.msg(res.msg, {icon: 1});
                    $('#url').val(res.path);
                }else{
                    layer.msg('上传失败', {icon: 2});
                }
            },
            error: function(){
                layer.msg('error'+ res.status, {icon: 2});
            }
        });
        form.on('submit(formDemo)',function (data){
            $.ajax({
                url:"/ttools/listening_add",
                type:"post",
                data:data.field,
                success:function (msg){
                    if(msg==='ok'){
                        layer.alert("添加成功",function (){
                            xadmin.del_tab();
                        });
                    }else{
                        layer.alert("信息未更新！");
                    }
                },
                error:function (){
                    layer.alert("未知错误！");
                }
            });
            return false;
        });
    });
</script>
</body>
</html>