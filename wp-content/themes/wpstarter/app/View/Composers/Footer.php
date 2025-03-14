<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer {
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'sections.footer',
    ];

    public function override() {
        return [
            'navMenuItemsColumn1' => $this->getNavMenuItemsColumn1(),
            'navMenuItemsColumn2' => $this->getNavMenuItemsColumn2(),
            'navMenuItemsColumn3' => $this->getNavMenuItemsColumn3(),
        ];
    }

    public function getNavMenuItemsColumn1(): array {
        $nav_menu_name = 'navigatie';

        return get_nav_menu_items_simple( $nav_menu_name );
    }

    public function getNavMenuItemsColumn2(): array {
        $nav_menu_name = 'over-ons';

        return get_nav_menu_items_simple( $nav_menu_name );
    }

    public function getNavMenuItemsColumn3(): array {
        $nav_menu_name = 'diensten';

        return get_nav_menu_items_simple( $nav_menu_name );
    }

    protected function is_acf_active(): bool {
        return class_exists( 'ACF' );
    }
}
