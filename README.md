# Camagru
A basic web app that allows users to take pictures using a webcam and superimpose predefined images onto them.


[Subject File](https://github.com/wethinkcode-students/web/blob/master/1%20-%20camagru/camagru.en.pdf)


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
	Password: root
	```
	> For security reasons, change these credentials later.
5. Navigate to http://localhost:8888/Camagru/config/database.php to create database and tables. (Port numbers, such as 8888, will vary per Mamp version)
6. Navigate to http://localhost:8888/Camagru/ to start login or create an account.
7. If creating a new account, you will need to verify it using the link sent to the email address you used during registration.

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
4. Configuration:
	* Sets up the database.
	* See `config/`.
5. Assets:
	* Application assets consisting of .jpeg and .png files used as backgrounds, overlays and logos.
	* See `filters/`, `icons/` and `images/`.

## Testing:
The [Marking Sheet](https://github.com/wethinkcode-students/web/blob/master/1%20-%20camagru/camagru.markingsheet.pdf) will be used as a testing outline. A more simplified Outline and Expected Outcomes are listed below.


1. Outline:
	1. Initial checks:
		* Uses PHP.
		* Uses no frameworks.
		* Uses PDO.
	2. Successfully start webserver.
	3. Register an account.
	4. Log in.
	5. Take picture using webcam.
	6. Superimpose predefined image onto picture.
	7. Add likes/comments to post with another account.
	8. Change user credentials/details.
2. Expected outcomes:
	1. Backend written in PHP, no frameworks used, used PDOs.
	2. Webserver starts successfully.
	3. Account created and persists across sessions.
	4. Can log in with credentials entered during registration.
	5. Able to capture picture with webcam.
	6. Able to superimpose image onto picture taken.
	7. Able to add likes/comments to posts. Persists across sessions.
	8. Able to edit user credentials/details.
