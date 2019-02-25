<?php

namespace cadvisitante\Http\Controllers;

use Illuminate\Http\Request;

use cadvisitante\Http\Requests;
use cadvisitante\Http\Controllers\Controller;
use cadvisitante\Model\LDAP\User as LDAPUser;

class Application extends Controller
{

    public function index()
    {
        return view('layout/base');
    }

}
