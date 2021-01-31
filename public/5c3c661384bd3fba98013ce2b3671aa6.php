<?php /*a:1:{s:20:"../view/welcome.html";i:1608688974;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="/css/font.css">
        <link rel="stylesheet" href="/css/xadmin.css">
        <script src="/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background-color:transparent" >
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">欢迎您！
                                当前时间: <span class="x-red"><?php echo htmlentities($time); ?></span>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">系统信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td><?php echo $_SERVER['SERVER_NAME'] ?></td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td><?php echo PHP_OS ?></td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td><?php echo $_SERVER["SERVER_SOFTWARE"] ?></td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td><?php echo PHP_VERSION ?></td></tr>
                                    <tr>
                                        <th>ThinkPHP</th>
                                        <td>6.0</td></tr>
                                    <tr>
                                        <th>上传附件限制</th>
                                        <td><?php echo ini_get('upload_max_filesize') ?></td></tr>
                                    <tr>
                                        <th>执行时间限制</th>
                                        <td><?php echo ini_get('max_execution_time')."秒" ?></td></tr>
                                    <tr>
                                        <th>剩余空间</th>
                                        <td><?php echo round((disk_free_space(".")/(1024*1024)),2).'M' ?></td></tr>
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