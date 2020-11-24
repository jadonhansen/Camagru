# Camagru
A basic web app that allows users to take pictures using a webcam and superimpose predefined images onto them.

#### Grade Achieved: 125 / 125

## Technologies:
- PHP
- MAMP
- JavaScript
- AJAX
- HTML
- CSS
- MySQL

## Developer setup:
1. [Install MAMP](https://www.mamp.info/en/downloads/).
2. Make sure htdocs/ folder is empty.
3. Clone repository into htdocs/.
	> You'll want to name the repository 'Camagru', or filters will not be usable.
4. Configure MySQL database credentials as follows:
	```
	User: root
	Password: qwerty
	```
	> For security reasons, change these credentials later.
5. Navigate to http://localhost:8080/config/database.php to create database and tables.

## Architecture:
The MVC design pattern was followed during development of this web app.
Application flow can be summarized as follows:

> UI -[user input]-> Controllers -[updates]-> Database

### Roadmap:
1. Model layer:
	* Consists of the database where user data is stored and the functions called to instantiate it.
	* Updates the View layer when appropriate.
	* See `config/database.php` and `php/db.php`.
2. View layer:
	* Consists of .php files containing HTML and PHP as well as HTML returned by Controller.
	* Serves as user interface.
	* Prompts user for input.
	* See `pages/`.
3. Controller layer:
	* Consists of PHP files containing functions that are tied to user inputs.
	* Manipulates Model layer based on user input.
	* See `php/`.
