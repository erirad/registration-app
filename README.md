# Registration App
## Project Overview	
The project is designed to register clients for a visit to a specialist. The customer waiting time is displayed.  Statistics are also collected on when a visit to a specialist is most convenient. The project is not designed to register customers at a specific hour, customers are waiting in line.
## Requirements
php above 7.1, mysql above 5.6
## Configuration instructions
Create new database in MySQL.

Change the connection settings for the database:

registration-app

--config.php

```bash
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','root');
    define('DBNAME','database_name');
    define('DOMAIN', 'http://127.0.0.1:8001/');
```
## Installation
Start services from the command line
```bash
registration-app> php -S 127.0.0.1:8001 
```
Install database.  
Go to link https://127.0.0.1:8001/install.php and database would be installed automatically.

Composer [install]( https://getcomposer.org/download/)

Update the Composer autoloader 
Run the command :
```bash
composer dumpautoload -o
```
## Operating instructions
Lightboard page – the waiting list is displayed.

Administration page – form to create a new client.

Specialist page – client administration page where the specialist confirms the completion of the client visit.

Visitor page – page for a customer to adjust or cancel a visit.

Statistic page – customer service statistics, which can be filtered by specialist.








