# Lecture 6

## Overview

- Using PHP to manipulate the database
  - Inserting
  - Deleting/Updating
  - SQL injection

## `INSERT`

- To insert data via an SQL INSERT command which has the syntax

  ```sql
  INSERT INTO tablename(attribute1, attribute2.......)
  VALUES(value1, value2.......)

  INSERT INTO customer(firstname, surname, address, contact)
  VALUES ('Janet', 'Fraser', '3 Street', '22222222')
  ```

### Using HTML Forms

- Most web-database applications make use of three basic techniques:

  1. Create a page (form) that requests information from a user and returns the
     collected data to a script or program (or possibly the same script or
     program).
  2. Instruct a script or program to process the information extracted from the
     form.
  3. Use a script or program to send some information back to the user regarding
     the process (success/error etc.).

```html
<html>
  <head>
    <title>Requesting Data From User</title>
  </head>
  <body bgcolor="wheat">
    <form method="post" action="displaypost.php">
      <p>Please type your name in the space below</p>
      <p>First Name <input type="text" name="fname" /></p>
      <p>Surname <input type="text" name="sname" /></p>
      <input type="Submit" value="Submit" />
      <input type="Reset" value="Clear Form Fields" />
    </form>
  </body>
</html>
```

### Query Strings

- Query Strings are passed as `name/value` pairs with a format of `?name=value`.
- If more than one value is passed they are concatenated using the `&` symbol
  `?fname=Janet&sname=Fraser`.
- There are 3 ways in which a Query String can be generated:

  - Via a form using the `GET` method.
  - Via an anchor tag/HTML link

    `<a href="page.php?fname=Janet&sname=Fraser">Click here</a>`.

  - Via a user typed HTTP address

    `http://localhost/request.php?fname=test&sname=other`.

### Error Checking

```php
<?php
$query="INSERT INTO customer (firstname,surname,address,contact)
        VALUES('$_POST[fname]', null,'$_POST[address]',
        '$_POST[contact]')";
$stmt = $dbh->prepare($query);
if (!$stmt->execute()) {
  $err= $stmt->errorInfo();
  echo "Error adding record to database – contact System Administrator
  Error is: <b>".$err[2]."</b>";
} else {
?>
<script language="JavaScript">
alert("Customer record successfully added");
</script> }
```

## `DELETE`

```sql
DELETE FROM customer WHERE cust_no = 1;
```

Typical way is to delete a record from a table

```php
<tr>
  <td><?php echo $row->firstname; ?></td>
  <td><?php echo $row->surname; ?></td>
  <td><?php echo $row->address; ?></td>
  <td><?php echo $row->contact; ?></td>
  <td>
    <a
      href="CustModify.php?custno=<?php echo $row->cust_no; ?>&Action=Delete">
      Delete
    </a>
  </td>
</tr>
```
