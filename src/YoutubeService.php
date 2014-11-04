<?php

namespace ladamalina\VideoHelper;

/**
 * Class YoutubeService
 * @package ladamalina\VideoHelper
 */
class YoutubeService extends AbstractService {

    const THUMB_SIZE_SQ = '1';
    const THUMB_SIZE_MQ = 'mqdefault';
    const THUMB_SIZE_HQ = 'hqdefault';

    private static $_hosts = ['youtube.com', 'www.youtube.com'];

    private static $_thumbUrl = 'http://img.youtube.com/vi/{$id}/{$size}.jpg';

    /**
     * Get video id by given url
     * @param $url
     * @return null
     */
    public function idByUrl($url) {
        $url_parts = parse_url($url);
        if (isset($url_parts['host']) and in_array($url_parts['host'], self::$_hosts)) {
            $query = $url_parts['query'];
            $params = explode('&', $query);
            foreach ($params as $pair) {
                list($key, $value) = explode('=', $pair);
                if ($key === 'v' and $value) {
                    return $value;
                }
            }
        }

        return null;
    }

    /**
     * Get thumbnail url by video id
     * @param $id
     * @param $size
     * @return mixed|null|string
     */
    public function thumbnailById($id, $size) {
        if ($id) {
            $url = self::$_thumbUrl;
            $url = str_replace('{$id}', $id, $url);
            $url = str_replace('{$size}', $size, $url);

            return $url;
        }

        return null;
    }

    /**
     * Get html embed code by video url
     * @param $id
     * @param int $width
     * @param int $height
     * @return null|string
     */
    public function embedCodeById($id, $width = self::EMBED_WIDTH_DEFAULT, $height = self::EMBED_HEIGHT_DEFAULT) {
        if ($id) {
            return "
                <iframe
                    width = '{$width}'
                    height = '{$height}'
                    src = '//www.youtube.com/embed/{$id}'
                    frameborder = '0'
                    allowfullscreen>
                </iframe>
            ";
        }

        return null;
    }
}
