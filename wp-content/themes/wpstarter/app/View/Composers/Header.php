<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'sections.header',
    ];

    public function override()
    {
        return [
            'navMenuItems' => $this->getNavMenuItems(),
        ];
    }

    public function getNavMenuItems(): array
    {
        $nav_menu_name = 'primary';

        return get_nav_menu_items_simple($nav_menu_name);
    }

    protected function is_acf_active(): bool
    {
        return class_exists('ACF');
    }
}
