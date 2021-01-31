<?php /*a:1:{s:33:"../view/teacher/writing-list.html";i:1609856204;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>成绩查看</title>
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
                    <div class="layui-card-body layui-table-body layui-table-main">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>考试编号</th>
                                <th>考试名称</th>
                                <th>学生编号</th>
                                <th>学生姓名</th>
                                <th>作文分数</th>
                                <th>作文批阅</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $key): ?>
                            <tr>
                                <td><?php echo htmlentities($eid); ?></td>
                                <td><?php echo htmlentities($ename); ?></td>
                                <td><?php echo htmlentities($key['sid']); ?></td>
                                <td><?php echo htmlentities($key['name']); ?></td>
                                <?php
                                    if($key['status']==0){
                                ?>
                                <td>未批改</td>
                                <?php
                                    }else{
                                ?>
                                <td><?php echo htmlentities($key['score']); ?></td>
                                <?php
                                    }
                                ?>
                                <td class="td_manage">
                                    <a title="作文批阅"  onclick="xadmin.open('<?php echo htmlentities($key['name']); ?>的作文','/page/write_review?eid=<?php echo htmlentities($eid); ?>&sid=<?php echo htmlentities($key['sid']); ?>',600,450);" href="javascript:;">
                                        <i class="layui-icon">&#xe642;</i>批阅
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>