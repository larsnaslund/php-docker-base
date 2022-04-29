# About
A very simple bundle to get up and running with PHP 8 (with the PDO and mysqli extentions), Apache, MySQL, and phpMyAdmin.


# How to run

**Requirements:** Docker

### Change database credentials - optional, but recommended
If you don't just want to get up and running right away, it's recommended you at least change the default database passwords. This can be done in the following files:

**`docker-compose.yml`** - change `rootpassword` with a password
```
MYSQL_ROOT_PASSWORD: rootpassword
```
**`database/schema.sql`** change `'password'` with a password
```
CREATE USER 'testuser'@'%' IDENTIFIED BY 'password';
GRANT ALL ON `test_database`.* TO 'testuser'@'%';
```

**`php/src/index.php`** change `'password'` with the password you set above for testuser.
```php
    $user = 'testuser';
    $password = 'password';
```

### Build and run container(s)
From inside the folder run the following command:
```
docker-compose up
```

This will set everything up providing us with:
- PHP 8 with the the following extensions installed: 
  -  PDO MySQL
  -  mysqli
- MySQL
  - With just a root password (see `docker-compose.yml` for details)
  - Executed schema defined in `database/schema.sql` providing us with:
    - A database named `test_database`
    - A user `testuser` with all the priviligies in `test_database`
    - An example table `notes` with two entries
- phpMyAdmin
  - With PMA_ARBITRARY enabled which you might want to change to something more restrictive

# Testing
Once everything is up and running, you can test things with the bundled example page residing in `php/scr/index.php`. 
It will enable strict types, register an autoloader, established a connection to the database and fetch some rows.

Visit example page: http://localhost:8000
Visit phpMyAdmin on http://localhost:8001


## Files of importance
- **docker-compose.yml**
- **database/schema.sql** - executed when containers are built, creating:
  - A database named `test_database`
  - A user named `testuser` who has all priviligies in `test_database` with a given password (see file)
  - An example table called `notes` with two entries
-  **php/src/index.php**
-  An example page which sets up an autoloader and connectes to the database with `testuser` and fetches some records from the `notes` table
- **Dockerfile**
  - Used to install the PHP extentions PDO MySQL and mysqli 
