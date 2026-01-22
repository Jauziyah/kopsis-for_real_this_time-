<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminTokoDisplayPage extends BaseController
{
    public function index()
    {
        return view('admin_toko/product');
    }
}


?>