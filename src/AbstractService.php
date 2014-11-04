<?php

namespace ladamalina\VideoHelper;


/**
 * Class AbstractService
 * @package ladamalina\VideoHelper
 */
abstract class AbstractService {

    public $url;
    public $id;

    const THUMB_SIZE_SQ = 'small';
    const THUMB_SIZE_MQ = 'medium';
    const THUMB_SIZE_HQ = 'large';

    const EMBED_WIDTH_DEFAULT = 500;
    const EMBED_HEIGHT_DEFAULT = 281;

    /**
     * Get video id by given url
     * @param $url
     * @return mixed
     */
    abstract public function idByUrl($url);

    /**
     * Get thumbnail
     * Size may be specified as static::THUMB_SIZE_SQ, static::THUMB_SIZE_MQ, static::THUMB_SIZE_HQ
     * @param $size
     * @return mixed
     */
    public function thumbnail($size) {
        if ($this->id) {
            return $this->thumbnailById($this->id, $size);
        }

        if ($this->url) {
            return $this->thumbnailByUrl($this->url, $size);
        }

        return null;
    }

    /**
     * Get thumbnail url by video id.
     * Size may be specified as static::THUMB_SIZE_SQ, static::THUMB_SIZE_MQ, static::THUMB_SIZE_HQ
     * @param $id
     * @param $size
     * @return mixed
     */
    abstract public function thumbnailById($id, $size = self::THUMB_SIZE_HQ);

    /**
     * Get thumbnail url by video url.
     * Size may be specified as static::THUMB_SIZE_SQ, static::THUMB_SIZE_MQ, static::THUMB_SIZE_HQ
     * @param $url
     * @param string $size
     * @return mixed
     */
    public function thumbnailByUrl($url, $size = self::THUMB_SIZE_HQ) {
        $this->id = $this->idByUrl($url);
        return $this->thumbnailById($this->idByUrl($url), $size);
    }

    /**
     * Get html embed code
     * @param $width
     * @param $height
     * @return mixed
     */
    public function embedCode($width, $height) {
        if ($this->id) {
            return $this->embedCodeById($this->id, $width, $height);
        }

        if ($this->url) {
            return $this->embedCodeByUrl($this->url, $width, $height);
        }

        return null;
    }

    /**
     * Get html embed code by video id
     * @param $id
     * @param $width
     * @param $height
     * @return mixed
     */
    abstract public function embedCodeById($id, $width = self::EMBED_WIDTH_DEFAULT, $height = self::EMBED_WIDTH_DEFAULT);

    /**
     * Get html embed code by video url
     * @param $url
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public function embedCodeByUrl($url, $width = self::EMBED_WIDTH_DEFAULT, $height = self::EMBED_WIDTH_DEFAULT) {
        return $this->embedCodeById($this->idByUrl($url), $width, $height);
    }
}
