VideoHelper provides functionality for embedding YouTube & Vimeo video.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ladamalina/video-helper "*"
```

or add

```
"ladamalina/video-helper": "*"
```

to the require section of your `composer.json` file.

## Usage

```php
use ladamalina\VideoHelper;
```

Get HTML embed code by Vimeo video URL

```php
$service = VideoHelper::serviceByUrl('https://vimeo.com/110713161');
// helper detects 'vimeo.com' and video id '110713161' in your link
echo $service->embedCode(500, 300); // 500x281 by default
```

Get HTML embed code by Youtube video URL

```php
$service = VideoHelper::serviceByUrl('https://www.youtube.com/watch?v=M7FIvfx5J10');
// helper detects 'youtube.com' and video id 'M7FIvfx5J10' in your link
echo $service->embedCode(); // 500x281 by default
```

Get thumbnail URL by Vimeo video ID

```php
// if you have video provider name and id (perhaps in your database)
$service = VideoHelper::serviceByName('Vimeo');
$service->id = '110713161';

// high quality
$url = $service->thumbnail($service::THUMB_SIZE_HQ);

// medium quality
$url = $service->thumbnail($service::THUMB_SIZE_MQ);

// standard quality
$url = $service->thumbnail($service::THUMB_SIZE_SQ);
```

Get thumbnail URL by Youtube video ID

```php
// if you have video provider name and id (perhaps in your database)
$service = VideoHelper::serviceByName('Youtube');
$service->id = 'M7FIvfx5J10';

// high quality
$url = $service->thumbnail($service::THUMB_SIZE_HQ);

// medium quality
$url = $service->thumbnail($service::THUMB_SIZE_MQ);

// standard quality
$url = $service->thumbnail($service::THUMB_SIZE_SQ);
```
