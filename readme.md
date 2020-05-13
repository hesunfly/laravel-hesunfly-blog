
## 项目概述
Laravel-hesunfly-blog 是一个简洁的博客应用，使用 Laravel5.5 编写而成，具有博客的基本功能。


## 运行环境要求

- Nginx 1.8+
- PHP 7.0+
- Mysql 5.7+
- Redis 3.0+

## 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.5](https://learnku.com/docs/laravel/5.5/) 开发，基本的运行环境可参考 Laravel5.5 文档。

### 基础安装

#### 1. 克隆源代码

克隆 `laravel-hesunfly-blog` 源代码到本地：

    > git clone git@gitee.com:hesunfly/laravel-hesunfly-blog.git

#### 3. 安装扩展包依赖

	composer install

#### 4. 生成配置文件

```
cp .env.example .env
```

你可以根据情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等：

```
APP_URL=http://hesunfly.test

DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

```

#### 5. 生成数据表及生成测试数据
```shell
$ php artisan migrate 
```

#### 7. 生成秘钥

```shell
php artisan key:generate
```



### 链接入口

* 首页地址：https://blog.hesunfly.com/
* 管理后台：https://blog.hesunfly.com/admin

初始化管理账户:
访问 APP_URL/init 初始化
管理员账号密码如下:

```
username: admin
password: 123456
```

至此, 安装完成 ^_^。

使用邮件订阅功能需要配置邮件信息：

```
MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

使用七牛云存储图片文件需要配置七牛云信息：
```
FILESYSTEM_DRIVER=qiniu

QINIU_DOMAIN=
QINIU_ACCESS_KEY=-
QINIU_SECRET_KEY=
QINIU_BUCKET=
```
