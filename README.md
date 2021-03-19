## 0. 项目说明

命令行相关测试样例。

使用命令行获取远程API接口数据存储到当前数据库。

```bash
php artisan import:users

# 或者
php artisan import:users --url=https://randomuser.me/api/?results=7&inc=gender,email,nat,phone
```
            
> **API地址**: https://randomuser.me/api/?results=7&inc=gender,email,nat,phone


## 1. 下载

```bash
git clone git@github.com:curder/laravel-console-command-test-demo.git
```

## 2. composer 安装组件

```bash
composer install
```

> 如果不存在composer 命令。通过链接 https://getcomposer.org/download/ 下载并安装 composer 命令。


## 3. 环境文件

在项目的根目录中附带一个 `.env.example` 文件，请将其拷贝重命名为 `.env` 。可以使用如下命令完成操作

```
cp .env.example .env
```

## 4. artisan命令

设置 Laravel 在进行加密时使用的密钥。

```bash
php artisan key:generate
```

应该看到一条绿色消息，指出您的密钥已成功生成，以及你应该看到 `.env` 文件中的 **app_key** 变量反映出来。

## 5. 创建数据库


```bash
touch database/database.sqlite
```

然后更新项目根目录下的 `.env` 文件上如下的相关行：

```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=homestead
# DB_USERNAME=homestead
# DB_PASSWORD=secret
```
