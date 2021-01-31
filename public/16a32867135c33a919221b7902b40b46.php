<?php /*a:1:{s:19:"../view/index1.html";i:1608537674;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>学生管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body class="index mybg8">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a >英语学习与测试平台</a>
    </div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('添加学生','member-add',430,550)">
                        <i class="layui-icon">&#xe770;</i>添加学生信息</a></dd>
                <dd>
                    <a onclick="xadmin.open('添加学籍变更','chang-add',430,480)">
                        <i class="layui-icon">&#xe60e;</i>添加学籍变更记录</a></dd>
                <dd>
                    <a onclick="xadmin.open('添加奖励','reward-add',430,480)">
                        <i class="layui-icon">&#xe6c6;</i>添加奖励记录</a></dd>
                <dd>
                    <a onclick="xadmin.open('添加处罚','punish-add',430,480)">
                        <i class="layui-icon">&#xe6c5;</i>添加处罚记录</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">欢迎您，<?php echo htmlentities($name); ?>教师</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <!--                        <dd>-->
                <!--                            <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd>-->
                <dd>
                    <a href="/Index/logout">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/">前台首页</a>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li">&#xe735;</i>
                    <cite>资源浏览</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('英语文章','tonji')">
                            <i class="layui-icon">&#xe6b2;</i>
                            <cite>英语文章</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('英语视频','member-list')">
                            <i class="layui-icon">&#xe62c;</i>
                            <cite>英语视频</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li">&#xe6b8;</i>
                    <cite>班级管理</cite>
                    <i class="iconfont nav_right">&#xe735;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('班级成员','admin-list')">
                            <i class="layui-icon">&#xe770;</i>
                            <cite>查看班级</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('班级排名','admin-list')">
                            <i class="iconfont">&#xe770;</i>
                            <cite>班级排名</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li">&#xe723;</i>
                    <cite>测试管理</cite>
                    <i class="iconfont nav_right">&#xe6b2;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('成绩查看','grade-list')">
                            <i class="iconfont">&#xe6b2;</i>
                            <cite>日常作业</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('成绩查看','grade-list')">
                            <i class="iconfont">&#xe6b2;</i>
                            <cite>期末考试</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li">&#xe723;</i>
                    <cite>成绩管理</cite>
                    <i class="iconfont nav_right">&#xe6b2;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('成绩查看','grade-list')">
                            <i class="iconfont">&#xe6b2;</i>
                            <cite>历史成绩</cite></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='/page/welcome' frameborder="0" scrolling="yes" class="x-iframe">

                </iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<!--        <div class="page-content-bg">-->
<!--            -->
<!--        </div>-->
<!--        <style id="theme_style">-->
<!--            -->
<!--        </style>-->
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
</body>

</html>