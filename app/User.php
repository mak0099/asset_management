<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use SoftDeletes;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function branch() {
        return $this->belongsToMany('App\Unit', 'user_has_branch', 'user_id', 'branch_id');
    }

    public function setBranch($branch_id) {
        $branch = Unit::find($branch_id);
        $this->branch()->save($branch);
        return $this;
    }
    public function updateBranch($branch_id) {
        $this->branch()->detach();
        return $this->setBranch($branch_id);
    }
    public function unit_id()
    {
        return $this->branch()->first()->id;
    }
    public function unit_name()
    {
        return $this->branch()->first()->unit_name;
    }
    public function unit_type()
    {
        return $this->branch()->first()->unit_type;
    }

}
