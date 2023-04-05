<?php

namespace App\View\Components;

use App\Helpers\GenerateQuote;
use Illuminate\View\Component;

class Quote extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $quote;

    public function __construct()
    {
        $this->quote = GenerateQuote::generate();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.quote');
    }
}
