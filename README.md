# lightweight-mysqli-database
PHP and MySQL is one of the most common stacks for web development, even in 2016.What is shocking that we don't have proper lightweight php-mysqli library. So i took it on myself to design a library which is lightweight and secured from sql injection. 
###WARNING: This project is still be worked on, so be carefull when updating!!

I have written the library keeping in mind the complexitiy of repeated writing of mysqli commands.
Any issue or suggestion can be mailed to be at seshu.93@gmail.com.
Incase you have any improvement to the project please do comment and coommit to the branch so the your awesome idea is noted and merged into the master.
Thanks in advance :P

##Changes:
- **2/10/16:** Added the library file with config.ini updated for further use.

##Method List:

####db_query([query]);
Query the database.
```php
$db = db_query("SELECT * FROM customer WHERE id = '101" && name = 'Paul' );
print_r($db);
```

####db_where([table,select,query])
Fetch rows from the database where certain command is fulfilled (SELECT and WHERE query).
```php
$db = db_where( "customer","job","WHERE id = '101" && name = 'Paul'" );
print_r($db);
```

####db_selectall([table])
Fetch all rows from given table in database(SELECT * query).
```php
$db = db_selectall( "customer");
print_r($db);
```

####db_insert([table,column,values])
Insert command in the mysqli(Insert query).
```php
$db = db_insert("customer","name,job","'Paul Adams','Web-Designer'");
print_r($db);
```

####db_update([table,values,condition])
Update the database (Update query).
```php
$db = db_update("customer","name = 'Bob'","name = 'Paul'");
print_r($db);
```

####db_delete([table,condition])
DELETE entry from  the database (Delete query).
```php
$db = db_delete("customer","name = 'Bob'");
print_r($db);
```

####db_quote([value])
Quote and escape value for use in a database query.
```php
echo db_quote("admin or 1=1");
```
