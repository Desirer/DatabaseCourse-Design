<?php /*a:1:{s:23:"../view/root/index.html";i:1611834878;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>英语学习平台后台管理系统</title>
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
            var is_remember = false;
        </script>
    </head>
    <body class="index mybg">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a >英语学习与测试平台</a>
            </div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">欢迎管理员</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('密码修改','/page/pwd',500,300)">密码修改</a></dd>
                        <dd>
                            <a href="/Index/logout">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
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
                            <i title="鼠标悬浮在图标上要有名称" class="iconfont left-nav-li">&#xe735;</i>
                            <cite>资源管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('英语文章','/page/article_list')">
                                    <i class="layui-icon">&#xe6b2;</i>
                                    <cite>英语文章</cite></a>
                            </li>
                            <li>
                                <a onclick="">
                                    <i class="layui-icon">&#xe62c;</i>
                                    <cite>文章管理</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li">&#xe6b8;</i>
                            <cite>用户管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('学生信息','/tools/student_list')">
                                    <i class="layui-icon">&#xe770;</i>
                                    <cite>学生信息管理</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('教师信息','/tools/teacher_list')">
                                    <i class="iconfont">&#xe770;</i>
                                    <cite>教师信息管理</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li">&#xe723;</i>
                            <cite>班级管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="">
                                    <i class="iconfont">&#xe6b2;</i>
                                    <cite>班级信息</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li">&#xe723;</i>
                            <cite>成绩管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="">
                                    <i class="iconfont">&#xe6b2;</i>
                                    <cite>学生成绩</cite></a>
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