<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 't_user';
    protected $primaryKey = 'id_user';

    protected $hidden = ['password_user'];
    protected $casts = ['password_user' => 'hashed'];

    protected $fillable = ['nama_user','username_user','password_user','role'];

    public function getAuthPassword(){
        return $this->password_user;
    }

    public function username(){
        return 'username_user';
    }

    public function getRoleName() : string {
        return $this->user->role;
    }

    public function hasRole($role): bool{
        return $this->user->role == $role;
    }
}
