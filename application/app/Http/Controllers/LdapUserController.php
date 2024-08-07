<?php

namespace App\Http\Controllers;

use App\Models\LdapUser; // Ensure you import the LdapUser model
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LdapUserController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Retrieve LDAP users grouped by company and department
            $users = LdapUser::all()->groupBy('company')->map(function ($companyGroup) {
                return $companyGroup->groupBy('department');
            });
            
            // Return the view with the grouped users
            return view('users.index', compact('users'));
        } catch (QueryException $e) {
            // Handle any database query exceptions
            return response()->view('errors.database', [], 500);
        }
    }
}

