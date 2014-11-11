<?php

namespace ladamalina\VideoHelper;


/**
 * Class VideoHelper provides functionality for embedding YouTube & Vimeo videos
 * @package ladamalina\VideoHelper
 */
class VideoHelper {

    /**
     * Hostnames used by Youtube & Vimeo
     * @var array
     */
    private static $_hosts = [
        'youtube.com' => 'Youtube',
        'm.youtube.com' => 'Youtube',
        'www.youtube.com' => 'Youtube',
        'vimeo.com' => 'Vimeo',
        'www.vimeo.com' => 'Vimeo',
    ];

    /**
     * Get service helper object by video url.
     * Returns null if service may not be detected by given url.
     * @param $url
     * @return mixed
     */
    public static function serviceByUrl($url) {
        $url_parts = parse_url($url);
        if (array_key_exists('host', $url_parts) and array_key_exists($url_parts['host'], self::$_hosts)) {
            $service = self::serviceByName(self::$_hosts[$url_parts['host']]);
            $service->url = $url;

            return $service;
        }

        return null;
    }

    /**
     * Get service helper object by service name.
     * Returns null if class of service does not exists.
     * @param $service_name
     * @return mixed
     */
    public static function serviceByName($service_name) {
        $service_class_name = self::_classnameByServiceName($service_name);
        if (class_exists($service_class_name)) {
            return new $service_class_name;
        }

        return null;
    }

    /**
     * Generate full classname by service name
     * @param $service_name
     * @return string
     */
    private static function _classnameByServiceName($service_name) {
        $service_name = ucfirst($service_name);

        return __NAMESPACE__ . '\\' . $service_name . 'Service';
    }
}
