一个简单的论坛

##需要环境软件
```shell script
$ apt-get install ffmpeg                              #linux FFmpeg是领先的多媒体框架，能够解码、编码、转码、mux、demux、流、过滤和播放几乎任何人类和机器创造的东西。
$ apt-get install supervisor                          #linux 操作系统监视器
```

##安装方法

```shell script
$ composer install                                    #conposer 安装 扩展 
$ cp .env.example .env                                #新建.env文件
```

打开`.env`文件开始编辑

```shell script
 DB_DATABASE= <填写数据库名称>
 DB_USERNAME= <填写自定义用户名>
 DB_PASSWORD= <填写自定义数据库密码>
```

```shell script
$ php artisan key:generate                                              #应用自身加密
$ php artisan jwt:secret                                                #jwt 令牌  
$ php artisan aetherupload:groups                                       #生成大文件上传的目录
ln -s <project-path>/storage/app/uploads/ <project-path>/public/        #创建连接文件
$ php artisan migrate                                                   #数据库迁移
$ npm install                                                           #npm 插件安装
$ npm run dev                                                           #运行编译scss
$ php artisan db:seed                                                   #数据播种 
```
