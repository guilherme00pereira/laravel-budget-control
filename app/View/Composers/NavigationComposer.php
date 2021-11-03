<?php


namespace App\View\Composers;


use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationComposer
{
    protected $cost_center;

    public function __construct(Request $request)
    {
        $this->cost_center = $request->session()->get('cost_center')[0];
    }

    public function compose(View $view)
    {
        $view->with('cost_center', $this->cost_center);
    }
}
