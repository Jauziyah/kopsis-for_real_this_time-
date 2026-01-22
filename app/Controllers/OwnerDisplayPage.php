<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

class OwnerDisplayPage extends BaseController
{
    public function index()
    {
        return view('owner/product');
    }
}


?>