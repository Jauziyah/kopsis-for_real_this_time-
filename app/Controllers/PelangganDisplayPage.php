<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

class PelangganDisplayPage extends BaseController
{
    public function index()
    {
        return view('pelanggan/main');
    }
}


?>