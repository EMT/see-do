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
        $this->categories = Category::orderBy('title', 'asc')->get();
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
