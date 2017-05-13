<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'id_department'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $have_role;

    public function department() {
        return $this->belongsTo(Department::class, 'id_department');
    }

    public function documents() {
        return $this->hasMany(Document::class, 'id_document', 'id_user');
    }

    public function role() {
        return $this->hasOne('App\Models\Role', 'id', 'id_role');
    }

    public function hasRole($roles) {
        $this->have_role = $this->getUserRole();

        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }

        return false;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;

    }

    public function getUserRole() {
        return $this->role()->first();
    }

    private function checkIfUserHasRole($need_role) {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }
}
