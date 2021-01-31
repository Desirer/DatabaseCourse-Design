<?php /*a:1:{s:30:"../view/student/exam-list.html";i:1609989752;}*/ ?>
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
<body style="background-color: transparent">
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
          </span>
    <a class="layui-btn layui-btn-normal" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form">
                        <div class="layui-input-inline">
                            <select lay-verify="choose" name="optioin">
                                <option value="">选择要查找的内容</option>
                                <option value="eid">测试编号</option>
                                <option value="tid">出卷教师编号</option>
                            </select>
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input lay-verify="message" name="message" type="text" placeholder="输入信息" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn layui-btn-normal"  lay-filter="search" lay-submit=""><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-normal" onclick="window.location.href='/stools/exam_list'">显示所有</button>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>测试编号</th>
                            <th>测试名称</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>出卷教师</th>
                            <th>测试班级</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list as $key): ?>
                        <tr>
                            <td><?php echo htmlentities($key['eid']); ?></td>
                            <td><?php echo htmlentities($key['name']); ?></td>
                            <td><?php echo htmlentities($key['stime']); ?></td>
                            <td><?php echo htmlentities($key['etime']); ?></td>
                            <td><?php echo htmlentities($key['tname']); ?></td>
                            <td><?php echo htmlentities($key['cno']); ?></td>
                            <td class="td-manage">
                                <button type="button" class="layui-btn layui-btn-normal" onclick="parent.window.location='/page/exam_start?eid=<?php echo htmlentities($key['eid']); ?>'">开始考试</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div>
                            <form class="layui-form">
                                <p class="layui-laypage-count"> 当前第<?php echo htmlentities($id+1); ?>页/共<?php echo htmlentities($page); ?>页(共 <?php echo htmlentities($num); ?>条记录)</p>
                                <?php if($id>0): ?>
                                <a class="prev" href="/ttools/exam_list?id=<?php echo htmlentities($id-1); ?>">上一页</a>
                                <?php endif; 
                                if($page>7){
                                for($i=($id-3);$i<=$id;$i++){
                                if($i>=1){
                                if($i==($id+1))
                                echo '<span class="current">'.$i.'</span>';
                                else
                                echo '<a class="num" href="/ttools/exam_list?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                for($i=($id+1);$i<=($id+5);$i++){
                                if($i<=$page){
                                if($i==($id+1))
                                echo '<span class="current">'.$i.'</span>';
                                else
                                echo '<a class="num" href="/ttools/exam_list?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                }else{
                                for($i=1;$i<=$page;$i++){
                                if($i==($id+1))
                                echo '<span class="current" >'.$i.'</span>';
                                else
                                echo '<a class="num" href="/ttools/exam?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                 if(($id+1)!=$page): ?>
                                <a class="next" href="/ttools/exam_list?id=<?php echo htmlentities($id+1); ?>">下一页</a>
                                <?php endif; ?>
                                <div class="layui-inline layui-show-xs-block">
                                    <input style="width:90px;height:37px" lay-verify="message" type="text" name="message" placeholder="输入页数" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button style="width:41px;height:37px" class="layui-btn" lay-submit lay-filter="goto"><i class="layui-icon">&#xe609;</i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script>
    layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;
            //自定义验证规则
            form.verify({
                choose:function (value) {
                    if(!value)
                        return '请选择搜索项！'
                },
                message:function (value) {
                    if(!value)
                        return '请输入要搜索的内容';
                }
            });
            //监听提交
            form.on('submit(search)',
                function(data) {
                    window.location.href="/stools/exam_list?choose="+data.field.optioin+"&message="+data.field.message;
                    return false;
                });
            //跳转页面
            form.on('submit(goto)',
                function(data) {
                    window.location.href="/stools/exam_list?id="+(data.field.message-1);
                    return false;
                });
        });
    layui.use(['laydate','form'], function(){
        var  form = layui.form;
        // 监听全选
        form.on('checkbox(checkall)', function(data){
            if(data.elem.checked){
                $('tbody input').prop('checked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');
        });
    });

    function exam_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //异步删除数据
            console.log(id);
            var result='err';
            del=$.ajax({
                type:'get',
                url:'/??',
                data:{
                    id:id
                },
                success:function (msg) {
                    result=msg;
                },
                error:function () {
                    layer.msg('删除失败!', {icon: 2, time: 1000});
                }
            });
            $.when(del).done(function (data) {
                if(result==='ok') {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }else{
                    layer.msg('删除失败!', {icon: 2, time: 1000});
                }
            });
        });
    }

</script>
</html>