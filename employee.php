<?php
$dbuser = 'postgres';
$dbpass = '123456789';
$dbhost = 'localhost';
$dbname = 'Tabel';
$connec = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

$db = pg_connect("host=localhost port=5432 dbname=Company02 user=postgres password=dave150909");
$sql = "select concat(e1.fname, ' ', e1.mname, ' ', e1.lname) as empname, e1.ssn, e1.bdate, e1.address, e1.sex, e1.salary, concat(e2.fname, ' ', e2.mname, ' ', e2.lname) as supname, dname
		from employee e1 left join employee e2 on (e1.superssn = e2.ssn) inner join department on (e1.dno = department.dnumber)
		order by empname";

// Insert employee data
if (isset($_POST['insert'])) {
	$query1 = "INSERT INTO employee (fname,mname, lname, ssn, bdate, address,sex,salary, superssn, dno) VALUES ('$_POST[fname]','$_POST[mname]',
    '$_POST[lname]','$_POST[ssn]','$_POST[bdate]','$_POST[address]','$_POST[sex]','$_POST[salary]','$_POST[superssn]','$_POST[dno]')";

	$result = pg_query($db, $query1);
	if (!$result) {
		echo "Insert failed!!";
	}
}

// Edit Employee data
if (isset($_POST['edit'])) {
	$query2 = "UPDATE employee SET fname = '$_POST[fname]', mname = '$_POST[mname]', lname = '$_POST[lname]', ssn = '$_POST[ssn]', bdate = '$_POST[bdate]', address = '$_POST[address]', sex = '$_POST[sex]', salary = '$_POST[salary]', superssn = '$_POST[superssn]', dno = '$_POST[dno]' WHERE ssn = '$_POST[tempssn]'";

	$result = pg_query($db, $query2);
	if (!$result) {
		echo "Edit failed!!";
	}
}

// Delete employee data
if (isset($_GET['ssn'])) {
	$sql = "DELETE FROM employee WHERE ssn = '" . $_GET["ssn"] . "'";
	$result = pg_query($sql);
	echo "<meta http-equiv=refresh content=1;URL='employee.php'>";
	if (!$result) {
		echo "delete failed!!";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			text-align: center;
			padding: 8px;
			border-style: solid;
			border-width: 1px;
		}

		td {
			text-align: left;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>

<body>
	<form action="employee-insert.php">
		<button type="submit">Add Employee</button>
	</form>

	<table>
		<tr>
			<th>Name</th>
			<th>SSN</th>
			<th>Birth Date</th>
			<th>Address</th>
			<th>Sex</th>
			<th>Salary</th>
			<th>Supervisor</th>
			<th>Department</th>
			<th>Action</th>
		</tr>
		<?php
		foreach ($connec->query($sql) as $row) {
		?>
			<tr>
				<td> <?php print $row['empname'] ?> </td>
				<td> <?php print $row['ssn'] ?> </td>
				<td> <?php print $row['bdate'] ?> </td>
				<td> <?php print $row['address'] ?> </td>
				<td> <?php print $row['sex'] ?> </td>
				<td> <?php print $row['salary'] ?> </td>
				<td> <?php print $row['supname'] ?> </td>
				<td> <?php print $row['dname'] ?> </td>
				<td><a href="editEmployee.php?ssn=<?php echo $row['ssn'] ?>"><button>Update</button></a></td>
			<?php
		}
			?>
	</table>
	<?php
	$db = pg_connect("host=localhost port=5432 dbname=Company02 user=postgres password=dave150909");

	?>
</body>

</html>