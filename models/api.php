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
        $response = wp_remote_get($endpoint);
        $body     = wp_remote_retrieve_body( $response );
        
        return (object) json_decode($body);
    }

    public function select_plugin($slug)
    {
        return $this->_call($this->endpoint_plugin_info.$slug.'.json');
    }
}