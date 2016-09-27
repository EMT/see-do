<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\Contracts\View\View;

class NavComposer
{
    protected $categories;

    /**
     * Create a new nav composer.
     */
    public function __construct()
    {
        $route = app()->router->getCurrentRoute();
        $city = $route->getParameter('city');

        $this->categories = Category::where('city_id', $city->id)->orderBy('title', 'asc')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories);
    }
}
