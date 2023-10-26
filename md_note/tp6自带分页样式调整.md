有些时候框架自带的分页并不能满足项目的需求，这时自定义分页样式就是首选了。此篇文章记录ThinkPHP6+Layui自定义分页样式的基础使用。

关于layui分页样式，自己到layui官方文档寻找自己喜欢的样式。

### 第一步：复制ThinkPHP6分页代码

找到ThinkPHP6分页代码到所需要的位置，

```php
// ThinkPHP6分页代码位置
// vendor\topthink\think-orm\src\paginator\driver\Bootstrap.php
```

复制到`Bootstrap.php`到所需要的位置并修改文件名。我这里复制到了`app\admin\CustomPaginate.php`

### 第二步：修改自定义分页CustomPaginate.php

```php
// app\admin\CustomPaginate.php

// 修改一：修改命名空间
namespace app\admin;

// 修改二：修改渲染分页html
/**
* 渲染分页html
* @return mixed
*/
public function render()
{
   if ($this->hasPages()) {
       if ($this->simple) {
           return sprintf(
               '<div class="layui-box layui-laypage layui-laypage-molv" id="layui-laypage-3">%s %s</div>',
               $this->getPreviousButton(),
               $this->getNextButton()
           );
       } else {
           return sprintf(
               '<div class="layui-box layui-laypage layui-laypage-molv" id="layui-laypage-3">%s %s %s</div>',
               $this->getPreviousButton(),
               $this->getLinks(),
               $this->getNextButton()
           );
       }
   }
}

//修改三：修改上一页按钮
protected function getPreviousButton(string $text = "上一页"): string{
}

//修改四：修改下一页按钮
protected function getNextButton(string $text = '下一页'): string{   
}

// 修改五：生成一个可点击的按钮
protected function getAvailablePageWrapper(string $url, string $page): string
{
   return '<a href="' . htmlentities($url) . '">' . $page . '</a>';
}

// 修改六：生成一个禁用的按钮
protected function getDisabledTextWrapper(string $text): string
{
   return '<a class="layui-laypage-prev layui-disabled">' . $text . '</a>';
}

// 修改七：生成一个激活的按钮
protected function getActivePageWrapper(string $text): string
{
return '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>' . $text . '</em></span>';
}
```

### 第三步：注册自定义分页

在`app\provide.php`文件中注册自定义分页。注册自定义分页后即是使用自定义分页。

```php
// app\provide.php
<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
   // ... 省略其他
   'think\Paginator'   => app\admin\CustomPaginate::class
];
```

经过这三个步骤后，自定义分页就完成了。

### 第四步：静态模板中使用分页

```html
<div>
{$lists|raw}
</div>
```

至此：自定义分页与使用完成。