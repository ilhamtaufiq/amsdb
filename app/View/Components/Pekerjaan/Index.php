<?php

namespace App\View\Components\Pekerjaan;

use Illuminate\View\Component;

class Index extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $pekerjaan)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pekerjaan.index');
    }
}
