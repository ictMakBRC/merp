<?php

namespace App\View\Components;

use App\Models\FacilityInformation;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public $facilityInfo;

    public function __construct()
    {
        $this->facilityInfo = FacilityInformation::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.footer');
    }
}
