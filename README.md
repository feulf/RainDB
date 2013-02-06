#Rain DB component

Rain DB is a component of the RainFramework 3 that works as wrapper for the PDO class.

## Usage

This class use Static methods to run the queries. Example:
``` php
use Rain\DB;

// include the autoloader
require "library/Rain/autoload.php";

// configure the class
DB::configure( array("config_dir"=>"config/"); );

// init the connection
DB::init();

// run a query get one row
DB::getRow("SELECT * FROM user LIMIT 1");
```

### Installation

You can copy this library in your project using composer.

After that you need to configure your connection

### Configure connection

This class accepts `mysql`, `pgsql`, `sqlite`, `oracle` and `odbc` drivers.

The one that the class uses is defined in the configuration file which by default is `config/db.php`, before using the class you need to edit this file and store your database user, password, etc.


#### Loading and initializate the library.

To load the class file you can use composer or a PSR autoloader.

After configurating the class you can initializate the library using the init method

```php
use Rain\DB;
require "library/Rain/autload.php";
DB::init();
```

#### Road Map, todo list and wish list, all of it together!
- select the type of return as array, object, or class (we may want to create a JSON, XML or YAML class with a method __toString )


