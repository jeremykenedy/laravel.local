## Laravel.local
#### An out the box Laravel 5.6 installation with authenticaion scaffolding in place. This is for example purposes.
##### Important Notes:
* Currently using for laravel-roles [reported issue](https://github.com/jeremykenedy/laravel-roles/issues/10#issuecomment-373195472) tested.
* A demo of [attching roles](https://github.com/jeremykenedy/laravel-roles#attaching-detaching-and-syncing-permissions )

#### Table of contents
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-the-front-end-assets-with-mix)
- [Notes](#notes)
- [Routes](#routes)
- [File Tree](#file-tree)
- [License](#license)

### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/laravel.local.git laravel.local`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database homestead;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run:
```
php artisan vendor:publish --tag=laravelroles && php artisan vendor:publish --tag=laravelusers
```
7. From the projects root folder run `php artisan key:generate`
8. From the projects root folder run `php artisan migrate`
9. From the projects root folder run `composer dump-autoload`
10. From the projects root folder run `php artisan db:seed`
11. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/5.6/homestead)

### Notes
If you receive file_put_content errors you may need to check that your `storage` and `bootstrap/cache` folders writable.
These can be done with:

1. From the projects root folder run `sudo chmod -R 755 storage bootstrap/cache`
2. From the projects root folder run `sudo chwon -R $USER:staff ../laravel.local`
    - Note: You may need to change `$USER:staff` to your web user and group.

### Routes
```
+--------+-----------+------------------------+------------------+----------------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                    | Name             | Action                                                                           | Middleware   |
+--------+-----------+------------------------+------------------+----------------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                      |                  | Closure                                                                          | web          |
|        | GET|HEAD  | api/user               |                  | Closure                                                                          | api,auth:api |
|        | GET|HEAD  | home                   | home             | App\Http\Controllers\HomeController@index                                        | web,auth     |
|        | POST      | login                  |                  | App\Http\Controllers\Auth\LoginController@login                                  | web,guest    |
|        | GET|HEAD  | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                          | web,guest    |
|        | POST      | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                                 | web          |
|        | POST      | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail            | web,guest    |
|        | GET|HEAD  | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm           | web,guest    |
|        | POST      | password/reset         |                  | App\Http\Controllers\Auth\ResetPasswordController@reset                          | web,guest    |
|        | GET|HEAD  | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm                  | web,guest    |
|        | GET|HEAD  | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm                | web,guest    |
|        | POST      | register               |                  | App\Http\Controllers\Auth\RegisterController@register                            | web,guest    |
|        | POST      | search-users           | search-users     | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@search  | web,auth     |
|        | POST      | users                  | users.store      | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@store   | web,auth     |
|        | GET|HEAD  | users                  | users            | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@index   | web,auth     |
|        | GET|HEAD  | users/create           | users.create     | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@create  | web,auth     |
|        | PUT|PATCH | users/{user}           | users.update     | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@update  | web,auth     |
|        | DELETE    | users/{user}           | user.destroy     | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@destroy | web,auth     |
|        | GET|HEAD  | users/{user}           | users.show       | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@show    | web,auth     |
|        | GET|HEAD  | users/{user}/edit      | users.edit       | jeremykenedy\laravelusers\app\Http\Controllers\UsersManagementController@edit    | web,auth     |
+--------+-----------+------------------------+------------------+----------------------------------------------------------------------------------+--------------+
```

### File Tree
```
├── .env.example
├── .gitattributes
├── .gitignore
├── app
│   ├── Console
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Auth
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── ResetPasswordController.php
│   │   │   ├── Controller.php
│   │   │   └── HomeController.php
│   │   ├── Kernel.php
│   │   └── Middleware
│   │       ├── EncryptCookies.php
│   │       ├── RedirectIfAuthenticated.php
│   │       ├── TrimStrings.php
│   │       ├── TrustProxies.php
│   │       └── VerifyCsrfToken.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   └── User.php
├── artisan
├── bootstrap
│   ├── app.php
│   └── cache
│       ├── .gitignore
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── laravelPhpInfo.php
│   ├── laravelusers.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── roles.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2016_01_15_105324_create_roles_table.php
│   │   ├── 2016_01_15_114412_create_role_user_table.php
│   │   ├── 2016_01_26_115212_create_permissions_table.php
│   │   ├── 2016_01_26_115523_create_permission_role_table.php
│   │   └── 2016_02_09_132439_create_permission_user_table.php
│   └── seeds
│       ├── ConnectRelationshipsSeeder.php
│       ├── DatabaseSeeder.php
│       ├── PermissionsTableSeeder.php
│       ├── RolesTableSeeder.php
│       └── UsersTableSeeder.php
├── package.json
├── phpunit.xml
├── public
│   ├── .htaccess
│   ├── css
│   │   └── app.css
│   ├── favicon.ico
│   ├── index.php
│   ├── js
│   │   └── app.js
│   └── robots.txt
├── readme.md
├── resources
│   ├── assets
│   │   ├── js
│   │   │   ├── app.js
│   │   │   ├── bootstrap.js
│   │   │   └── components
│   │   │       └── ExampleComponent.vue
│   │   └── sass
│   │       ├── _variables.scss
│   │       └── app.scss
│   ├── lang
│   │   └── en
│   │       ├── auth.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       └── validation.php
│   └── views
│       ├── auth
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   └── register.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── server.php
├── webpack.mix.js
└── yarn.lock
```
* Tree command can be installed using brew: `brew install tree`
* File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests'`

### License
Laravel.local is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
