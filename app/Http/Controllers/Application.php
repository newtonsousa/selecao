<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;

use selecao\Http\Requests;
use selecao\Http\Controllers\Controller;
use selecao\Model\LDAP\User as LDAPUser;

class Application extends Controller
{

    public function index()
    {
        return view('layout/base');
    }

}
