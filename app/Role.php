<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Config;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];

    //Class name must be a valid object or a string
    //YOU CAN FIX IT WITH MASTER BRANCH OF ENTRUST

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('entrust.role_user_table'),Config::get('entrust.role_foreign_key'),Config::get('entrust.user_foreign_key'));
       // return $this->belongsToMany(Config::get('auth.providers.users.model')), Config::get('entrust.role_user_table'));
    }
}
