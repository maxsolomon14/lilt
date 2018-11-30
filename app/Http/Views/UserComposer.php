<?php

namespace App\Http\Views;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\User;

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
        $findUser = User::all();
        $view->withUserNow(Auth::user())->withFindUser($findUser);
    }
}
