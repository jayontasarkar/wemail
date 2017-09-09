<?php

namespace WeDevs\WeMail\Modules\Lists;

use WeDevs\WeMail\Framework\Module;

class Lists extends Module {

    public $menu_priority = 90;

    public function __construct() {
        $this->add_filter( 'wemail-admin-submenu', 'register_submenu', $this->menu_priority, 2 );
    }

    public function register_submenu( $menu_items, $capability ) {
        $menu_items[] = [ __( 'Lists', 'wemail' ), $capability, 'admin.php?page=wemail#/lists' ];

        return $menu_items;
    }

    public function get_lists_initial_data() {
        $data = [
            'modelA' => 'Model A data from Home.php ' . current_time( 'mysql' ),
            'notInStore' => 'not found in store'
        ];

        $this->send_success( $data );
    }

}
