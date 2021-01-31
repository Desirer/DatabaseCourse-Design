<?php /*a:1:{s:31:"../view/student/join-class.html";i:1611717641;}*/ ?>
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
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <select  name="cno" >
                <option value="">选择班级</option>
                <?php foreach($class as $c): ?>
                <option value="<?php echo htmlentities($c['cno']); ?>"><?php echo htmlentities($c['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(formDemo)',function (data){
            $.ajax({
                url:"/stools/join_class",
                type:"post",
                data:{
                    cno:data.field.cno,
                },
                success:function (msg){
                    if(msg==='ok'){
                        layer.alert("加入班级成功",function (){
                            xadmin.close();
                        });
                    }else{
                        layer.alert('错误！');
                    }
                },
                error:function (msg){
                    layer.alert('错误！');
                }
            });
        });
    });
</script>
</body>
</html>