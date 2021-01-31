<?php /*a:1:{s:25:"../view/article-list.html";i:1609988345;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>英语文章</title>
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
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
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
                                <option value="ano">文章编号</option>
                                <option value="head">文章标题</option>
                                <option value="tid">作者</option>
                            </select>
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input lay-verify="message" name="message" type="text" placeholder="输入信息" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-filter="search" lay-submit=""><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>文章编号</th>
                            <th>文章标题</th>
                            <th>发布教师</th>
                            <th>详细情况</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list as $key): ?>
                        <tr>
                            <td><?php echo htmlentities($key['ano']); ?></td>
                            <td><?php echo htmlentities($key['head']); ?></td>
                            <td><?php echo htmlentities($key['tname']); ?></td>
                            <td class="td-manage">
                                <a title="查看"  onclick="parent.xadmin.add_tab('<?php echo htmlentities($key['head']); ?>','/page/article_content?ano=<?php echo htmlentities($key['ano']); ?>');" href="javascript:;">
                                    <i class="layui-icon">&#xe655;</i>查看
                                </a>
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
                                <a class="prev" href="/page/ariticle_list?id=<?php echo htmlentities($id-1); ?>">上一页</a>
                                <?php endif; 
                                if($page>7){
                                for($i=($id-3);$i<=$id;$i++){
                                if($i>=1){
                                if($i==($id+1))
                                echo '<span class="current">'.$i.'</span>';
                                else
                                echo '<a class="num" href="/page/ariticle_list?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                for($i=($id+1);$i<=($id+5);$i++){
                                if($i<=$page){
                                if($i==($id+1))
                                echo '<span class="current">'.$i.'</span>';
                                else
                                echo '<a class="num" href="/page/ariticle_list?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                }else{
                                for($i=1;$i<=$page;$i++){
                                if($i==($id+1))
                                echo '<span class="current">'.$i.'</span>';
                                else
                                echo '<a class="num" href="/page/ariticle_list?id='.($i-1).'">'.$i.'</a>';
                                }
                                }
                                 if(($id+1)!=$page): ?>
                                <a class="next" href="/page/ariticle_list?id=<?php echo htmlentities($id+1); ?>">下一页</a>
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
                    // layer.msg('搜索!', {icon: 1, time: 1000});
                    window.location.href="/page/article_list?choose="+data.field.optioin+"&message="+data.field.message;
                    return false;
                });
            //跳转页面
            form.on('submit(goto)',
                function(data) {
                    window.location.href="/page/article_list?id="+(data.field.message-1);
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
</script>
</html>