<?php

namespace App\Http\Views;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withUserNow(Auth::user())->withFindUser(User::all());
    }
}
