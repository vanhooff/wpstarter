<?php

namespace app\View\Components\Elements;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component {
    /**
     * Create a new component instance.
     *
     * @param string $size
     */
    public function __construct(
        public ?string $size = 'base',
        public ?string $type = 'link',
        public ?string $href = '#',
        public ?string $action = '',
        public ?bool $newTab = false,
        public ?string $buttonType = 'button',
        public ?string $mode = 'normal',
        public ?bool $fullWidth = false
    ) {
        $this->size = in_array( $this->size, [ 'xs', 'sm', 'base', 'lg' ] ) ? $this->size : 'base';
        $this->type = in_array( $this->type, [ 'link', 'button' ] ) ? $this->type : 'link';
        $this->mode = in_array( $this->mode, [ 'normal', 'outline', 'ghost' ] ) ? $this->mode : 'normal';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view( 'components.elements.button', [ 'size' => $this->size ] );
    }
}
