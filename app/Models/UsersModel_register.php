<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsersModel_register extends Model
{
    protected $table            = 'user_biznet';
    protected $protectFields    = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}


?>