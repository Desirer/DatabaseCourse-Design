<?php /*a:1:{s:32:"../view/teacher/writing-add.html";i:1611819773;}*/ ?>
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
<form class="layui-form" >
    <div class="layui-form-item">
        <label class="layui-form-label">作文主题</label>
        <div class="layui-input-block">
            <textarea name="subject" placeholder="请输入作文主题" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分值</label>
        <div class="layui-input-block">
            <input type="text" name="value" required  lay-verify="required" placeholder="请输入分值" autocomplete="off" class="layui-input">
        </div>
    </div>
    <input type="hidden" name="eid" value="<?php echo htmlentities($eid); ?>"><!--    提交考试编号-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(formDemo)',function (data){
            $.ajax({
                url:"/ttools/writing_add",
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