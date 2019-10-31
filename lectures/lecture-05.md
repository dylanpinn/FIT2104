# Lecture 5: Using PHP to access data stores

## Overview

1. Using PHP to access data stores
   - MySQL
   - Oracle
   - PHP Data Objects (PDO)

## Connection to datastores

- PHP can access a number of different datastores:
  - dBase
  - FilePro
  - Ingres
  - MySQL
  - MS SQL Server
  - Oracle
- However a connection to some of these cannot be made wihtout some
  configuration and/or extra files, for example
  - To access local or remote Oracle database from your local web server
    - You will require Oracle Client Libraries
    - Need to make a minor change to the `php.ini` file.

### MySQL

- MySQL is an Open Source database

#### Examples

- Create a table and populate it with some data

  ```sql
  CREATE TABLE Customer
  (
    cust_no     INTEGER auto_increment,
    firstname   VARCHAR(20),
    surname     VARCHAR(20),
    address     VARCHAR(40),
    contact     VARCHAR(10),
    CONSTRAINT PK_Customer PRIMARY KEY (cust_no)
  );
  ```

- `auto_increment` creates an automatically incremented value for each new
  recored added
- Insert some data

  ```sql
  INSERT INTO Customer (firstname, surname, address, contact)
  VALUES ('Bilbo', 'Baggins', '21 Bag End', '988899');
  ```

- We now have a table with data which we can access via PHP

  ```php
  <?php
  $conn = mysqli_connect("host", "user", "password", "database");
  $query = "SELECT * FROM Customer";
  $result = mysqli_query($conn, $query);
  ?>
  ```

- All PHP MySQLI functions are prefixed by `mysqli`

  - Connection syntax `mysqli_connect(hostname, username, password, db);`
    - Hostname would be `127.0.0.1` or `localhost` for a local MySQL instance.
    - If this function is successful, it returns an object representing the
      connection to the DB server. If unsuccessful it returns false
    - If we omit the DB name, each query would need to be prefixed with the DB
      name as its possible for a MySQL user to have access to more than one DB.
    - This function can take 2 further arguments - MySQL port number and socket.
  - An SQL statement is assigned to a variable
  - The `mysqli_query` function is then used to execute the query against the
    database we connected to using the connection object.
  - The function returns a `mysqli_result` object which is assigned to the
    `$result` variable

```php
<?php
while ($row = mysqli_fetch_row($result))
{
?>
  <tr>
    <td><?php echo $row[0]; ?></td>
    <td><?php echo $row[1]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
  </tr>
<?php
}
?>
```

- `mysqli_fetch_row` returns a result row as an enumerated array.
- This is used as part of the `while` loop to retrieve all database rows

```php
<?php
while ($row = mysqli_fetch_array($result))
{
?>
  <tr>
    <td><?php echo $row[0]; ?></td>
    <td><?php echo $row["firstname"]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row["contact"]; ?></td>
  </tr>
<?php
}
?>
```

- `mysqli_fetch_array` returns an associative and a numerical array representing
  a database row
- We can use attribute names or ordinal values or a combination of both.

```php
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
```

- `mysqli_free_result` frees all memory associated with the specified result
  identifier
  - Really only needs to be called if we are worried about how much memory is
    being used when we return large result sets as all memory is freed once a
    script has finished executing
    - Still good practice and can't hurt
- `mysqli_close` closes the connection that's associated with the specified
  database connection object
  - Like `mysqli_free_result` this is not strictly necessary as open links are
    automatically closed once the script has completed execution

#### MySQL - OO

- The `mysqli` extension actual returns object rather than identifiers
- We can use object notation

  ```php
  <?php
  while ($row = $result->fetch_object())
  {
  ?>
    <tr>
      <td><?php echo $row->cust_no ?></td>
      <td><?php echo $row->firstname ?></td>
      <td><?php echo $row->surname ?></td>
      <td><?php echo $row->address ?></td>
      <td><?php echo $row->contact ?></td>
    </tr>
  <?php
  }
  ?>
  ```

- Loop through `mysqli_result` object, retrieving each row as an object and
  display values using attribute names.

```php
<?php
$result->free();
$conn->close();
?>
```

- Free the resources associated with `mysqli_result` object and close DB
  connection.
- No difference in the output from the previous example, only in execution.
- Object notation is marginally faster.

### Oracle

#### Examples

- Create a table and populate it with some data

  ```sql
  CREATE TABLE Customer
  (
    cust_no     INTEGER,
    firstname   VARCHAR(20),
    surname     VARCHAR(20),
    address     VARCHAR(40),
    contact     VARCHAR(10),
    CONSTRAINT PK_Customer PRIMARY KEY (cust_no)
  );

  CREATE SEQUENCE cust_seq;
  ```

- A sequence is used as Oracle's answer to an auto-increment field.
- Insert some data

  ```sql
  INSERT INTO Customer
  VALUES (cust_seq.nextval, 'Bilbo', 'Baggins', '21 Bag End', '988899');
  ```

- We now have a table with data which we can access via PHP

  ```php
  <?php
  $conn = oci_connect("user", "password", "db");
  $query = "SELECT * FROM Customer";
  $stmt = oci_parse($conn, $query);
  oci_execute($stmt);
  ?>
  ```

- All PHP Oracle functions are prefixed by `oci`
  - Connection syntax `oci_connect(username, password, db);`
    - $3^{rd}$ parameter is optional and refers to an Oracle alias
    - If omitted, PHP will attempt to connect to a local database.
    - If this function is successful, it returns a connection identifier we use
      in other `oci` calls.
    - If unsuccessful the function will return false
  - An SQL statement is assigned to a variable
- `oci_parse` checks the SQL statement for validity and returns a statement
  identifier if the query is valid and false if not.
- Takes 2 parameters - a connection identifier and a query or a variable which
  holds a query.
