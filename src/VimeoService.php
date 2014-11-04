<?php

namespace ladamalina\VideoHelper;

/**
 * Class VimeoService
 * @package ladamalina\VideoHelper
 */
class VimeoService extends AbstractService {

    /**
     * Get video id by given url
     * @param $url
     * @return int
     */
    public function idByUrl($url) {
        return (int) substr(parse_url($url, PHP_URL_PATH), 1);
    }

    /**
     * Get video info from vimeo api
     * @param $id
     * @return mixed
     */
    private function _getInfo($id) {
        if (!function_exists('curl_init')) die('CURL is not installed!');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = unserialize(curl_exec($ch));
        $output = $output[0];
        curl_close($ch);
        return $output;
    }

    /**
     * Get thumbnail url by video id
     * @param $id
     * @param string $size
     * @return null
     */
    public function thumbnailById($id, $size) {
        if ($id) {
            $info = self::_getInfo($id);
            $index = 'thumbnail_'.$size;
            if (array_key_exists($index, $info)) {
                return $info[$index];
            }
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
        return $id ? "<iframe
            src = '//player.vimeo.com/video/{$id}'
            width = '{$width}'
            height = '{$height}'
            frameborder = '0'
            webkitallowfullscreen
            mozallowfullscreen
            allowfullscreen>
        </iframe>" : null;
    }
}
