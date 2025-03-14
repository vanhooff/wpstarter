<?php

namespace App\View\Components\Navigation\Footers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer1 extends Component {
    /**
     * Create a new component instance.
     */
    public function __construct
    (
        public array $navMenuItemsColumn1 = [],
        public array $navMenuItemsColumn2 = [],
        public array $navMenuItemsColumn3 = [],
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view( 'components.navigation.footers.footer1' );
    }
}
