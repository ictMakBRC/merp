<?php

namespace App\View\Components;

use App\Models\HospitalInformation;
use Illuminate\View\Component;

class GeneralLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $facilityInfo;

    public function __construct()
    {
        $this->facilityInfo = HospitalInformation::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.GeneralLayout');
    }
}
