# atom-feed
atom-feed是一个采用Atom协议的用于生成网站聚合应用信息的一个简单的PHP程序。
##安装
环境要求：PHP >= 5.4
直接使用composer命令安装：

```
composer require "soyaf518/atom-feed:~1.0"
```
或者添加如下代码到composer.json文件中：

```
{
    "require": {
        "soyaf518/atom-feed" : "~1.0"
    }
}
```
然后运行composer来安装它

```
composer install
```
使用前引入 "vendor/autoload.php" 文件：

```
require_once 'vendor/autoload.php';
```
##使用

```
<?php
require_once dirname(__DIR__)."/vendor/autoload.php";

use Soyaf518\XMLBuilder\Atom;
use Soyaf518\XMLBuilder\Feed;
use Soyaf518\XMLBuilder\Entry;

$atom = new Atom();

$feed = new Feed();
$feed->title('title')
     ->subtitle('subtitle')
     ->id('http://www.example.com')
     ->updated(time())
     ->link(['href' => 'http://www.example.com'])
     ->link(['href' => 'http://www.example.com/atom.xml', 'rel' => 'self'])
     ->rights('© 2005 Example, Inc.')
     ->appendTo($atom);


$entry = new Entry();
$entry->id('http://www.example.com/article/1')
      ->title('article title 1')
      ->subtitle('article subtitle 1')
      ->summary('article summary 1')
      ->content('article content 1')
      ->category(['term' => 'category1', 'scheme' => 'http://www.ucoolife.com/category/category1'])
      ->author(['name' => 'kevin', 'email' => 'example@gmail.com', 'uri' => 'http://example.com/~kevin'])
      ->appendTo($feed);

$entry = new Entry();
$entry->id('http://www.example.com/article/2')
      ->title('article title 2')
      ->subtitle('article subtitle 2')
      ->summary('article summary 2')
      ->content('article content 2')
      ->category(['term' => 'category2', 'scheme' => 'http://www.ucoolife.com/category/category2'])
      ->author(['name' => 'kevin', 'email' => 'example@gmail.com', 'uri' => 'http://example.com/~kevin'])
      ->appendTo($feed);

header('Content-type:application/atom+xml; charset=utf-8');
echo $atom;
```
上面代码涵盖常用用法，更多请查看接口文件源码：[AtomInterface](https://github.com/soyaf518/atom-feed/blob/master/src/XMLBuilder/AtomInterface.php)、[FeedInterface](https://github.com/soyaf518/atom-feed/blob/master/src/XMLBuilder/FeedInterface.php)和[EntryInterface](https://github.com/soyaf518/atom-feed/blob/master/src/XMLBuilder/EntryInterface.php)

##参考

* [About atom feed](http://atomenabled.org/developers/syndication/#whatIsAtom)

##License
MIT
