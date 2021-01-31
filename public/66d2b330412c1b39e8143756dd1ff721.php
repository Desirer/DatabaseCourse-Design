<?php /*a:1:{s:36:"../view/teacher/exam-score-list.html";i:1609922073;}*/ ?>
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
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form" action="/page/exam_score_list" method="get">
                        <div class="layui-input-inline">
                            <select lay-verify="choose" name="eid">
                                <option value="">选择考试</option>
                                <?php foreach($elist as $da): ?>
                                <option value="<?php echo htmlentities($da['eid']); ?>"><?php echo htmlentities($da['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  ><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>学生编号</th>
                            <th>学生学号</th>
                            <th>学生姓名</th>
                            <th>单选成绩</th>
                            <th>作文成绩</th>
                            <th>总成绩</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list as $key): ?>
                        <tr>
                            <td><?php echo htmlentities($key['sid']); ?></td>
                            <td><?php echo htmlentities($key['sno']); ?></td>
                            <td><?php echo htmlentities($key['name']); ?></td>
                            <td><?php echo htmlentities($key['grade']); ?></td>
<!--                            grade==第一部分成绩-->
                            <td><?php echo htmlentities($key['score']); ?></td>
                            <td><?php echo htmlentities($key['grade']+$key['score']); ?></td>
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
<script>
    layui.use('form', function(){
        var form = layui.form;
        监听提交
    });
</script>
</html>