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