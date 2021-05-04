
# PizzaDays

## Project is based on  Laravel 5.4 
* [Programing Languages](#programing)
* [Features](#feature1)
* [Requirements](#feature2)
* [How to install](#feature3)
* [Troubleshooting](#feature5)
* [License](#feature6)
* [Additional information](#feature7)
* [Crud Generator](#feature9)

<a name="programing"></a>
## Programing Languages used in this project:
* Html
* Css
* Sass
* Jquery
* Ajax
* Php
* MySql
* Frameworks: 
	* Laravel 5.4.x
	* Twitter Bootstrap 4.x

-----
<a name="feature1"></a>
## Starter Site Features:
* Laravel 5.4.x
* Twitter Bootstrap 4.x
* Back-end
	* Automatic install and setup website.
	* User management.
	* Role management.
	* Dashboard.
	* Gentelella Dashboard Ready.
* Front-end
	* User login, registration, shop ect..
	* The shop is in VueJs
* Packages included:
	* Datatables Bundle
	* Sentinel
	* Crud generator

-----
<a name="feature2"></a>
##Requirements

	PHP >= 5.6.4
	OpenSSL PHP Extension
	PDO PHP Extension
	Mbstring PHP Extension
	Tokenizer PHP Extension
	XML PHP Extension

-----
<a name="feature3"></a>
##How to install:
* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)

-----
<a name="step1"></a>
### Step 1: Get the code - Download the repository
	You can Donwload the repositori from the server or using our bitucket repository
Extract it in www(or htdocs if you using XAMPP or MAMP) folder and put it for example in Starter folder.

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies

Laravel utilizes [Composer](http://getcomposer.org/) to manage its dependencies. First, download a copy of the composer.phar.
Once you have the PHAR archive, you can either keep it in your local project directory or move to
usr/local/bin to use it globally on your system.
On Windows, you can use the Composer [Windows installer](https://getcomposer.org/Composer-Setup.exe).
Open terminal and go to the project foleder
Then run:

    composer dump-autoload
    composer install --no-scripts

-----
<a name="step3"></a>
### Step 3: Create database

If you finished first three steps, now you can create database on your database server(MySQL). You must create database
with utf-8 collation(uft8_general_ci), to install and application work perfectly.
Just go to the phpmyadmin and create the new database
After that, copy .env.example and rename it as .env and put connection and change default database connection name, only database connection, put name database, database username and password.

-----
<a name="step4"></a>
### Step 4: Install

Now that you have the environment configured, you need to create a database configuration for it. For create database tables use this command:

    php artisan migrate

And to initial populate database use this:

    php artisan db:seed

If you install on your localhost in folder ProjectFolder, you can type on web browser:

	http://localhost/ProjectFolder/public

OR Run the command " php artisan serv ", and open on the browser the url you get in console :):


-----
<a name="step5"></a>
### Step 5: Start Page

You can now login to admin part of Laravel Framework 5.4  Site:

    username: admin@admin.com
    password: admin


-----
<a name="feature5"></a>
## Troubleshooting

### RuntimeException : No supported encrypter found. The cipher and / or key length are invalid.

    php artisan key:generate

### Site loading very slow

	composer dump-autoload --optimize
OR

    php artisan dump-autoload

-----
<a name="feature6"></a>
## License

This is free software distributed under the terms of the MIT license

-----
<a name="feature7"></a>
## Additional information

Inspired by Laravel 5.4 and based on:
[Crud Generator](https://github.com/roladn/laravelcrud)
[Gentelella Dashboard](https://goo.gl/NI1sGa)
[Sentinel Authentication](https://cartalyst.com/manual/sentinel/2.0)

<a name="feature9"></a>
## Crud Generator
Note: You should have configured database for this operation.

## Commands

#### Crud command:

```
php artisan crud:generate Posts --fields="title:string, body:text"
```

You can also easily include route, set primary key, set views directory etc through options **--route**, **--pk**, **--view-path** as belows:

```
php artisan crud:generate Posts --fields="title:string:required, body:text:required" --route=yes --pk=id --view-path="admin" --namespace=Admin --route-group=admin
```

If you are interested in  CRUD Generator then visit below links for more commands
[Crud Generator](https://github.com/roladn/laravelcrud#commands)