<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\LoginController;

class LoginAdd extends LoginController{


public function loginView()
{
    return parent::loginView();
}

public function loginAction(): RedirectResponse
{
    $response = parent::loginAction();

    if(auth()->loggedIn()){
        $user = auth()->user();

        if($user->inGroup('owner')){
            redirect()->route('owner.product_view');
        } elseif($user->inGroup('admin_toko')){
            redirect()->route('admin_toko.product_view');
        } elseif($user->inGroup('pelanggan')){
            redirect()->route('pelanggan.main_view');
        }


    }

    return $response;
}
}

?>