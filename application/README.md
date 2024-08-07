
## About the Application
This application is the response to the requirements of the assessement in which the following requirements are met:
# Usage: 
- Unzip the application and navigate to the application folder and run
```
$ docker compose up -d
```
- Update your .env and config/ldap.php files to reflect your ldap server credentials then after running the following command:
```
$ php artisan vendor:publish --provider="LdapRecord\Laravel\LdapServiceProvider"
```
- You can then run the following command to test the ldap connection:
```
$ php artisan ldap:test
```
- Authentication: The application implements Laravel Breeze for providing basic authentication
- Database Interaction: The application retrieve user data from an ldap server using the following command: 
```
$ php artisan ldap:import users
```
- User Interface: Laravel Breeze provides a simple user friendly interface
- Error Handling: All authentication errors are handled by Laravel Breeze

## Hosting Environment

- Docker

