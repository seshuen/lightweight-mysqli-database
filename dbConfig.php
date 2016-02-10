<?php
/**
 *
 *  @link       www.marketingtools.briefkase.in
 *  @author     seshu en <seshu@briefkase.in>
 *  @version    1.0
 *  @copyright  (c) 2016 - 2017 Seshu En
 *  @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE
*/

/**
* Connect to the database
*
* @return bool false on failure / mysqli MySQLi object instance on success
*/
        function db_connect() {

          // Define connection as a static variable, to avoid connecting more than once
          static $connection;
          // Try and connect to the database, if a connection has not been established yet
          if(!isset($connection)) {
          // Load configuration as an array. Use the actual location of your configuration file
          // Put the configuration file outside of the document root
          //$config['dbname']
          $config = parse_ini_file('./config.ini');
              $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
          }
          // If connection was not successful, handle the error
          if($connection === false) {
              // Handle error - notify administrator, log to a file, show an error screen, etc.
              return mysqli_connect_error();
          }
          return $connection;
        }
/**
* Query the database
*
* @param $query The query string
* @return mixed The result of the mysqli::query() function
*/
        function db_query($query) {
          // Connect to the database
          $connection = db_connect();
          // Query the database
          $result = mysqli_query($connection,$query);
          return $result;
        }
/**
* Fetch rows from the database where certeain command is fulfilled (SELECT and WHERE query)
*
* @param $query The query string $table The Table to select from & $select to select the table coulumns
* @return $array returns multidimensional array of count and result
*/
        function db_where($table,$select,$query) {
          $rows = array();
          $statement = 'SELECT '.$select.' FROM '.$table.' WHERE '.$query;
          $result = db_query($statement);
          // If query failed, return `false`
          if($result === false) {
              return db_error();
          }
          // If query was successful, retrieve all the rows into an array
          while ($row = mysqli_fetch_assoc($result)) {
              $rows[] = $row;
          }
          $count = mysqli_num_rows($result);
          $array = array();
          $array[] = $rows;
          $array[] = array('count' => $count);
          return $array ;
        }
/**
* Fetch all rows from the database (SELECT * query)
*
* @param $query The query string. $table The table to select
* @return $array returns multidimensional array of count and result
*/
                function db_selectall($table) {
                  $rows = array();
                  $query = 'SELECT * FROM '.$table;
                  $result = db_query($query);
                  // If query failed, return `false`
                  if($result === false) {
                      return db_error();
                  }
                  // If query was successful, retrieve all the rows into an array
                  while ($row = mysqli_fetch_assoc($result)) {
                      $rows[] = $row;
                  }
                  $count = mysqli_num_rows($result);
                  $array = array();
                  $array[] = $rows;
                  $array[] = array('count' => $count);
                  return $array ;
                }

/**
* Insert into  the database (Insert query)
*
* @param $vales The values string. $table The table to select $column the columns of table
* @return bool
*/
                    function db_insert($table,$column,$values) {
                    $rows = array();
                    $query = 'INSERT INTO '.$table.' ('.$column.') VALUES('.$values.' )';
                    $result = db_query($query);
                    // If query failed, return `false`
                    if($result === false) {
                    return db_error();
                    }
                    // If query was successful, retrieve all the rows into an array

                    return "<strong>Inserted successfully into ".$table." with values:".$values."</strong>" ;
                    }


/**
* Update the database (Update query)
*UPDATE example SET age='22' WHERE age='21'
* @param $values The values string. $table The table to select $condition the condition to be applied
* @return bool
*/
                    function db_update($table,$values,$condition) {
                    $rows = array();
                    $query = 'UPDATE '.$table.' SET '.$values.' WHERE '.$condition;
                    $result = db_query($query);
                    // If query failed, return `false`
                    if($result === false) {
                    return db_error();
                    }
                    // If query was successful, retrieve all the rows into an array

                    return "<strong>Updated successfully into ".$table." with values:".$values."</strong>" ;
              }

/**
* DELETE entry from  the database (Delete query)
* DELETE FROM example WHERE age='15
* @param $values The values string. $table The table to select $condition the condition to be applied
* @return bool
*/
              function db_delete($table,$condition) {
              $rows = array();
              $query = 'DELETE FROM '.$table.' WHERE '.$condition;
              $result = db_query($query);
              // If query failed, return `false`
              if($result === false) {
              return db_error();
              }
              // If query was successful, retrieve all the rows into an array

              return "<strong>Deleted successfully from  ".$table." with condition:".$condition."</strong>" ;
              }



/**
* Fetch the last error from the database
*
* @return string Database error message
*/
        function db_error() {
          $connection = db_connect();
          return mysqli_error($connection);
        }
/**
* Quote and escape value for use in a database query
*
* @param string $value The value to be quoted and escaped
* @return string The quoted and escaped string
*/
        function db_quote($value) {
          $connection = db_connect();
          return "'" . mysqli_real_escape_string($connection,$value) . "'";
        }
