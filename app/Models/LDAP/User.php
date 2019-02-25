<?php

namespace cadvisitante\Models\LDAP;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public static function getAllUsers() {
        $all_users = \Adldap::search()->all();
        return self::toMatrix($all_users);
    }

    public static function get($user) {

        if(isset($user) and ! empty($user)) {
            return \Adldap::search()->where('cn', 'contains', $user)->get();
        }

        return false;
    }

    public static function toMatrix($object) {
        foreach ($object as $key => $value) {
            $valores[$key]['name'] = $value->name[0];
            $valores[$key]['username'] = $value->samaccountname[0];
            $valores[$key]['email'] = $value->userprincipalname[0];
        }

        return $valores;
    }
}
