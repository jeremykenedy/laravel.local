## Laravel.local
#### An out the box Laravel 5.6 installation with authenticaion scaffolding in place. All factory Laravel. This is for example purposes.

#### Table of contents
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#rebuild-front-end-assets-with-mix)
- [Notes](#notes)

### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/laravel.local.git laravel.local`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database homestead;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

### Notes
If you receive file_put_content errors you may need to check that your `storage` and `bootstrap/cache` folders writable.
These can be done with:

1. From the projects root folder run `sudo chmod -R 755 storage bootstra/cache`
2. From the projects root folder run `sudo chwon -R $USER:staff ../laravel.local`
    - Note: You may need to change `$USER:staff` to your web user and group.
