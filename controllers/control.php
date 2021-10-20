<?php namespace F13\WordPress\Controllers;

class Control
{
    public function __construct()
    {
        add_shortcode('f13-wordpress', array($this, 'plugin'));
    }

    public function _check_cache( $timeout )
    {
        if ( (int) $timeout < 1 ) {
            $timeout = 1;
        }

        $timeout = $timeout * 60;

        return $timeout;
    }

    public function plugin($atts)
    {
        extract( shortcode_atts(array ('slug' => 'none', 'cache' => 1), $atts ));
        $cache = $this->_check_cache( $cache );

        $cache_key = 'f13_wordpress'.sha1(F13_WORDPRESS['Version'].'-'.$slug.'-'.$cache);
        $transient = get_transient( $cache_key );
        if ( $transient ) {
            echo '<script>console.log("Building WordPress plugin shortcode from transient: '.$cache_key.'");</script>';
            return $transient;
        }

        $m = new \F13\WordPress\Models\Api();
        $data = $m->select_plugin($slug);

        if (property_exists($data, 'error') && $data->error) {
            $e = '<div class="f13-wordpress-error">';
                $e .= __('Error', 'f13-wordpress').': '.$data->error;
            $e .= '</div>';
            return $e;
        }

        $v = new \F13\WordPress\Views\Shortcode(array(
            'data' => $data,
        ));

        $return = $v->plugin();

        set_transient($cache_key, $return, $cache);
        
        $return .= '<script>console.log("Building WordPress plugin shortcode from API, setting transient: '.$cache_key.'");</script>';

        return $return;
    }
}