<?php 

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'user_biznet';
    protected $protectFields    = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $returnType       = 'array'; 
    protected $updatedField  = 'updated_at';

    public function getUserBiznet()
    {
        $users_id = auth()->id();
        return $this->where('users_id', $users_id)->first();
    }

    public function getActiveBiznetId()
    {
        $user = $this->getUserBiznet();
        return $user ? $user['id_user_biznet'] : null;
    }

}


?>