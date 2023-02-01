<?php

namespace App\View\Components\Kegiatan;

use Illuminate\View\Component;

class Single extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $kegiatan)
    {
        //
        $this->kegiatan = $kegiatan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kegiatan.single');
    }
}
