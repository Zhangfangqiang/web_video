一个简单的论坛


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
$ php artisan key:generate                            #应用自身加密
$ php artisan migrate                                 #数据库迁移
$ npm install                                         #npm 插件安装
$ npm run dev                                         #运行编译scss
$ php artisan db:seed                                 #数据播种 
```
