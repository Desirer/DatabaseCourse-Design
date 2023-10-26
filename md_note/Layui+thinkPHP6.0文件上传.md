# Layui+thinkPHP6.0文件上传

## 1、写在前面

1. Layui文件上传逻辑：异步上传（点击按钮就将文件上传到服务器，然后再返回线上图片地址，等提交表单提交时 ，将其它表单信息和图片的线上地址一起提交 ）
2. 先给我自己可行的代码

## 2、Layui前端代码说明

```html
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">标签</label>
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="firstID">
                <i class="layui-icon">&#xe67c;</i>上传按钮
            </button>
            <input type="hidden" name="url" id="secondID">
        </div>
    </div>
</form>
```

上面这段代码声明了一个layui表单，里面有一个按钮和一个隐藏的input。

```js
<script>
    layui.use(['upload','form'], function(){
        var upload = layui.upload;
        var form = layui.form;
        upload.render({
            elem: '#firstID', 			//选中你要绑定的上传组件
            url: '/datatest/upload',//上传接口
            accept:'file',					//文件类型，不写默认是images，file表示全类型
            done: function(res){		//上传完回调，这里的res必须是json类型
                if (res.status === 200) {
                    layer.msg(res.msg, {icon: 1});
                    $('#secondID').val(res.path);  //回填路径值
                }else{
                    layer.msg('上传失败', {icon: 2});
                }
            },
            error: function(){
                layer.msg('error'+ res.status, {icon: 2});
            }
        });
    });
</script>
```

注意，官网文档里特别说明了接口返回信息必须是严格的JSON格式，详见官方文档https://www.layui.com/doc/modules/upload.html

## 3、thinkPHP6.0后端代码

​	tp6的官方代码对于上传这部分的描写着实是坑。先给我自己的代码：

```php
class DataTest{
  public function upload(){
    $file = request()->file('file');  //这里‘file’是你提交时的name
    try{
        validate(['goodFile' => [     //goodFile是你自定义的键名，目的是为了对check里数组中的
            'fileSize' =>50*1024*1024,//goodFile字段值进行验证;允许文件大小
            'fileExt'  => array('mp3','wav'),  //允许的文件后缀
            ]])->check(['goodFile'=>$file]);//也就是对上传的$file进行验证
        $saveName = \think\facade\Filesystem::disk('public')->putFile( 'music', $file);//保存文件名
        $arr = ['status' => 200, 'msg' => '成功', 'path' => app()->getRootPath().'public/storage'.$saveName];
        return json($arr);   				//返回标准json格式
    }catch (\Exception $e) {
        return $this->exceptionHandle($e,'上传失败!' . $e->getMessage(),'json','');
    }
	}
}

```

### 	首先，对于 

```php
$files = request()->file('file');
```

File()这个函数本身并没有‘file’参数，这里的‘file只是’你提交时input的name。不过layui时绑定组件提交，并没有显式地给出name（这里就是个大坑），尝试多次后才确定‘file‘可行。

如果你把前端代码改成

```html
 <input type="file" name="yourName" vlaue="请上传文件">
```

那么你后端代码就要改成这样，亲测有效

```php
$files = request()->file('yourName');
```

### 其次

```php
validate()->check()
```

Check()里面只能是一个数组，也就是我上面写的['goodFile'=>$file]。而官方文档里确直接把$file给填进去了，这是为什么呢？让我们看一下官方文档的代码

```php
//官方文档代码
public function upload(){
    // 获取表单上传文件
    $files = request()->file(); //注意这里
    try {
        validate(['image'=>'filesize:10240|fileExt:jpg|image:200,200,jpg'])
            ->check($files);  //注意这里
        $savename = [];
        foreach($files as $file) {
            $savename[] = \think\facade\Filesystem::putFile( 'topic', $file);
        }
    } catch (\think\exception\ValidateException $e) {
        echo $e->getMessage();
    }
}
```

可以看到作者写的file函数里面是不带参数的，这样得到的$files就是是一个数组，而validate里面就是验证$files里字段为‘image’的值。而且从后面的foreach来看，这里是多文件上传。作者实在太懒，也有可能文档实在太多。

### 最后对于路径值

```php
$saveName = \think\facade\Filesystem::disk('public')->putFile( 'music', $file);//保存文件名
$arr = ['status' => 200, 'msg' => '成功', 'path' => app()->getRootPath().'public/storage/'.$saveName];
```

这里默认会在public/storage/music/目录下保存文件。

如果你需要保存到别处，这里你需要修改：项目根目录->config.php->filesystem.php

```php
<?php

return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public/storage', 
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        // 更多的磁盘配置信息
    ],
];
```

具体是修改public里的root和url，把后面的storage改为你想要的文件名。

### 注意点

在你修改允许文件大小后还有可能会失败，因为你可能忘了修改php.ini里的默认**upload_max_filesize**允许上传文件大小

**1、打开php.ini**



**2、查找post_max_size:(修改上传大小限制)**

表单提交最大数值,此项不是限制上传单个文件的大小,而是针对整个表单的提交数据进行限制的默认为8m，设置为自己需要的值，此参数建议要设置比upload_max_filesize大一些

 

**3、查找file uploads:\**(修改上传开关限制)\****

是否允许通过http上传文件的开关，确认file_uploads = on

 

**4、查找upload_tmp_dir:\**(修改上传临时文件限制)\****

文件上传至服务器上存储临时文件的地方，如果没指定就会用系统默认的临时文件夹如果系统报错提示有“xxx临时目录xxx”的话，这个目录就需要你来设置一个有效目录，没报错就不用管

 

**5、查找upload_max_filesize:\**(修改上传大小限制)\****

允 许上传文件大小的最大值，默认为2m，设置为自己需要的值此参数建议不要超过post_max_size值，因为它受控于post_max_size值 (就算upload_max_filesize设置了1g，

而post_max_size只设置了2m时，大于2m的文件照样传不上去，因为它受控于 post_max_size值)

 

**6、如果要上传大于8m的文件，还需要对下面的参数也进行设置:(修改上传时间限制)**

查找max_execution_time = 600 ;每个php页面运行的最大时间值(秒)，默认30秒

max_input_time = 600 ;每个php页面接收数据所需的最大时间，默认60秒

memory_limit = 8m ;每个php页面所需要的最大内存，默认8m

