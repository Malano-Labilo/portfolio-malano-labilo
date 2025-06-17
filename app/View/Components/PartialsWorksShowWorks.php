<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PartialsWorksShowWorks extends Component
{
    /**
     * Create a new component instance.
     */
    public $show, $title;

    public function __construct($show = [], $title = "")
    {
        $this->show = $show;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partials.works.show-works');
    }
}
