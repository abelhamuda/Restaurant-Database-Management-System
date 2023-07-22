<?php
$db = pg_connect("host=localhost port=5432 dbname=Tabel user=postgres password=123456789");

$sql = pg_query($db, "select * from employee where ssn = '$_GET[ssn]'");
$data = pg_fetch_array($sql);


$result_sssn = pg_query($db, "select ssn, concat(fname,' ', mname,' ', lname) as sname from emp_supervisor order by ssn =" . $data['superssn'] . "desc");
$result_dno = pg_query($db, "select dnumber,dname from department order by dnumber = " . $data['dno'] . "desc");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Employee</title>
</head>

<body>
    <h2>Edit Employee Data</h2>
    <form name="edit" action="employee.php" method="POST">
        <table>
            <tr>
                <th>Name</th>
                <td>
                    <input type="text" name="fname" placeholder="First Name" value="<?php echo $data['fname'] ?>">
                    <input type="text" name="mname" placeholder="Middle Name Initial" value="<?php echo $data['mname'] ?>">
                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname'] ?>">
                </td>
            </tr>
            <tr>
                <th>SSN</th>
                <td><input type="text" name="ssn" placeholder="ssn" value="<?php echo $data['ssn'] ?>"></td>
                <td><input type="hidden" name="tempssn" placeholder="ssn" value="<?php echo $data['ssn'] ?>"></td>
            </tr>
            <tr>
                <th>Birth Date</th>
                <td><input type="date" name="bdate" value="<?php echo $data['bdate'] ?>"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input type="text" name="address" placeholder="address" value="<?php echo $data['address'] ?>"></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td><input type="text" name="sex" placeholder="sex" value="<?php echo $data['sex'] ?>"></td>
            </tr>
            <tr>
                <th>Salary</th>
                <td><input type="text" name="salary" placeholder="salary" value="<?php echo $data['salary'] ?>"></td>
            </tr>
            <tr>
                <th>Supervisor</th>
                <td><select name="superssn">
                        <?php while ($row = pg_fetch_row($result_sssn)) { ?>
                            <option value="<?php print($row[0]); ?>"><?php print($row[1]); ?></option>
                        <?php } ?>
                        <?php if ($data['superssn'] == 0) { ?>
                            <option value="0" selected>None</option>
                        <?php } else { ?>
                            <option value="0">None</option>
                        <?php } ?>
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
                <td colspan="2"><input type="submit" name="edit" value="Edit Employee"></td>
            </tr>
        </table>
    </form>

</body>

</html>