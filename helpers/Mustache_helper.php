<?php
/**
 *
 */
namespace lld\helpers;

class Mustache_helper {
    private static $instance = null;
    private static $m;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    private function __construct() {

    }
    public function init($mustache) {
        self::$m = $mustache;
    }
    public function render(string $template, array $attrs, $echo = true) {
        $result = self::$m->render( file_get_contents( $template ), $attrs );
        if ( $echo ) {
            echo $result;
        } else {
            return $result;
        }
    }
    public function render_str(string $string, array $attrs, $echo = true) {
        $result = self::$m->render( $string, $attrs );
        if ( $echo ) {
            echo $result;
        } else {
            return $result;
        }
    }

}
