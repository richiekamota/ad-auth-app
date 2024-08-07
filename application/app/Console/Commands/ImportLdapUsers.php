<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LdapRecord\Connection;
use App\Models\User;

class ImportLdapUsers extends Command
{
    protected $signature = 'ldap:import-users';
    protected $description = 'Import users from LDAP';

    protected $ldap;

    public function __construct(Connection $ldap)
    {
        parent::__construct();
        $this->ldap = $ldap;
    }

    public function handle()
    {
        $users = $this->ldap->query()
         ->where('objectClass', 'inetOrgPerson')
         ->orWhere('objectClass', 'organizationalPerson')
         ->orWhere('objectClass', 'person')
         ->get();

        foreach ($users as $ldapUser) {
            // Create or update the user in the database
            User::updateOrCreate(
                ['guid' => $ldapUser->getAttribute('uid')[0]], // Use the LDAP uid as the unique identifier
                [
                    'name' => $ldapUser->getAttribute('cn')[0],
                    'email' => $ldapUser->getAttribute('mail')[0],
                    'password' => $ldapUser->getAttribute('userPassword')[0],
                    'org' => $ldapUser->getAttribute('o')[0] ?? null,
                    'org_unit' => $ldapUser->getAttribute('ou')[0] ?? null,
                ]
            );
        }

        $this->info('Users imported successfully.');
    }
}
