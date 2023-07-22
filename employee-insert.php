<?php
$db = pg_connect("host=localhost port=5432 dbname=Tabel user=postgres password=123456789");


$result_sssn = pg_query($db, "select ssn, concat(fname,' ', mname,' ', lname) as sname from emp_supervisor");
$result_dno = pg_query($db, "select dnumber,dname from department");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter New Employee</title>
</head>

<body>
    <h2>Enter New Employee Data</h2>
    <form name="insert" action="employee.php" method="POST">
        <table>
            <tr>
                <th>Name</th>
                <td><input type="text" name="fname" placeholder="First Name"><input type="text" name="mname" placeholder="Middle Name Initial"><input type="text" name="lname" placeholder="Last Name"></td>
            </tr>
            <tr>
                <th>SSN</th>
                <td><input type="text" name="ssn" placeholder="ssn"></td>
            </tr>
            <tr>
                <th>Birth Date</th>
                <td><input type="date" name="bdate"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input type="text" name="address" placeholder="address"></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td><input type="text" name="sex" placeholder="sex"></td>
            </tr>
            <tr>
                <th>Salary</th>
                <td><input type="text" name="salary" placeholder="salary"></td>
            </tr>
            <tr>
                <th>Supervisor</th>
                <td><select name="superssn">
                        <?php while ($row = pg_fetch_row($result_sssn)) { ?>
                            <option value="<?php print($row[0]); ?>"><?php print($row[1]); ?></option>
                        <?php } ?>
                        <option value="0">None</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Department</th>
                <td><select name="dno">
                        <?php while ($row = pg_fetch_row($result_dno)) { ?>
                            <option value="<?php print($row[0]); ?>"><?php print($row[1]); ?></option>
                        <?php } ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="insert" value="Add Employee"></td>
            </tr>
        </table>
    </form>
</body>

</html>