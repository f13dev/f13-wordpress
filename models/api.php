<?php namespace F13\WordPress\Models;

class Api
{
    public $endpoint_plugin_info;

    public function __construct()
    {
        $this->endpoint_plugin_info = 'https://api.wordpress.org/plugins/info/1.0/';
    }

    public function _call($endpoint)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $endpoint);
        curl_setopt($c, CURLOPT_HTTPGET, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($c), true);
        curl_close($c);

        return (object) $result;
    }

    public function select_plugin($slug)
    {
        return $this->_call($this->endpoint_plugin_info.$slug.'.json');
    }
}