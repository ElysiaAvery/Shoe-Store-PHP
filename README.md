# Shoe Store
A web app that displays the multiple-to-multiple database relationship between stores and shoe brands.

#### By _[**Elysia Avery Nason**](https://github.com/elysiaavery)_

## Specs

Input Behavior | Input | Output
---------------|-------|--------
Can set a store's name and ID | Store (name, id); | "Running Shoes Plus", 1
Can save a store to the DB | "Running Shoes Plus", 1 | n/a
Can retrieve all stores  | Store::getAll() | "Running Shoes Plus", "Only Clogz"
Can find a store based on ID | "Running Shoes Plus", 1 | localhost:8000/stores/1, "Running Shoes Plus"
Can set a brand's name, ID, and store ID | Brand (name, id); | "Nike", 1
Can save a brand to the DB | "Nike", 1 | n/a
Can retrieve all brands  | Brand::getAll() | "Nike", "Reebok"
All of a store's brands can be retrieved | getBrands(); | "Nike", "Reebok"
All of a brand's stores can be retrieved | getStores(); | "Running Shoes Plus", "Only Clogz"
Can find a brand based on ID | "Reebok", 2 | localhost:8000/brands/2, "Running Shoes Plus"
A store's name can be updated | old name: "Running Shoes Plus", new name: "Running Shoes +" | "Running Shoes +"
A brand's name can be updated | old name: "Reebok", new name: "Reebok-Adidas" | "Reebok-Adidas"
A store can be deleted from the DB | "Running Shoes +" delete() | n/a
A brand can be deleted from the DB | "Nike" delete() | n/a

## Setup/Installation Requirements

* In your terminal window:
  * `$ git clone https://github.com/ElysiaAvery/Shoe-Store-PHP` to your Desktop.
* navigate to the project directory: `$ cd Shoe-Store-PHP`
* In a new terminal window enter: `$ composer install`
* In a separate terminal window, navigate to the web folder: `$ cd web`
  * `$ php -S localhost:8000`
* In a separate terminal window (from the top of the project directory), enter: `$ mysql.server start`
  * `$ mysql -uroot -proot` or `$ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
* In a separate terminal window (from the top of the project directory), enter: `$ apachectl start`
  * Navigate to http://localhost:8888/phpmyadmin in a browser and login using root as the username and password.
  * Then click the Import tab at the top and choose `shoes.sql` from the Shoe-Store-PHP folder.
* Navigate to localhost:8000 in the browser of your choice. (This app was tested in Chrome).

## MySQL Commands

* `mysql> CREATE DATABASE shoes;`
* `mysql> USE shoes;`
* `mysql> CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));`
* `mysql> CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));`
* `mysql> CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id int, brand_id int);`

## Known Bugs

None

## Support and contact details

Elysia Nason: _elysia.avery@gmail.com_

## Technologies Used

_PHP,
Silex,
Twig,
PHPUnit,
MySQL,
Apache_

### License

This webpage is licensed under the GPL license.

Copyright &copy; 2017 **_Elysia Avery Nason_**
