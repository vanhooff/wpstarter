<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Contact extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $subject = 'Contact',
        public $successMessage = 'Bedankt voor uw bericht! Wij nemen zo spoedig mogelijk contact met u op.'
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.contact');
    }
}
