<?php /*a:1:{s:30:"../view/teacher/exam-edit.html";i:1611749078;}*/ ?>
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
        <label class="layui-form-label">测试名称</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($data['name']); ?>" required  lay-verify="required" placeholder="请输入考试名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">开始时间</label>
        <div class="layui-input-inline">
            <input id="stime" name="stime" value="<?php echo htmlentities($data['stime']); ?>" type="text" lay-verify="time" class="layui-input" >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">结束时间</label>
        <div class="layui-input-inline">
            <input id="etime" name="etime" value="<?php echo htmlentities($data['etime']); ?>" type="text"  class="layui-input"  >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">考试对象</label>
        <div class="layui-input-inline">
            <select  name="cno" >
<!--                <option value="">选择班级</option>-->
                <?php foreach($class as $c): ?>
                <option value="<?php echo htmlentities($c['cno']); ?>" <?php if($data['cno']==$c['cno']): ?>checked=""<?php endif; ?> ><?php echo htmlentities($c['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="eid" value="<?php echo htmlentities($data['eid']); ?>">
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
                url:"/ttools/exam_edit",
                type:"post",
                data:data.field,
                success:function (msg){
                    if(msg==='ok'){
                        layer.alert("修改成功",function (){
                            xadmin.close();
                            parent.location.reload();
                        });
                    }else{
                        layer.alert("信息未修改！");
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
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#stime'
            ,type: 'datetime'
            ,format: 'yyyy-MM-dd-HH-mm-ss' //可任意组合
        });
    });
</script>

</body>
</html>