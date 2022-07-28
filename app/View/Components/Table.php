<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * The action.
     *
     * @var boolean
     */
    public $action;

    /**
     * Create a new component instance.
     *
     * @param  boolean  $action
     * @param  array  $keys
     * @return void
     */
    public function __construct($action, $keys)
    {
        $this->action = $action;
        $this->keys = $keys;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table', ['keys' => $this->keys]);
    }
}
