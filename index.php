<?php

require_once 'dbconfig.php';
include 'helper-function.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "<p>Connected to $dbname at $host successfully.</p>";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$strJsonFileContents = file_get_contents("./Code-Challenge.json");
$array = json_decode($strJsonFileContents, true);

// $query="insert into jsondb values('','$array[participation_id]','$array[LastName]')";

foreach ($array as $data) {
    $participation_id = $data['participation_id'];
    $employee_name = $data['employee_name'];
    $employee_mail = $data['employee_mail'];
    $event_id = $data['event_id'];
    $event_name = $data['event_name'];
    $participation_fee = $data['participation_fee'];
    $event_date = $data['event_date'];
    // var_dump($data['participation_id']);
    $query = "INSERT INTO codechallenge(participation_id, employee_name, employee_mail, event_id, event_name, participation_fee, event_date)
    VALUES('$participation_id', '$employee_name', '$employee_mail', '$event_id', '$event_name', '$participation_fee', '$event_date')";
    $conn->query($query);

}

echo "<p>Data Imported Sucessfully from JSON!</p>";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <title>PHP MySQL Query Data Demo</title>
    </head>
<body>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">Employees Data</h3>
        <hr style="border-top:1px dotted #ccc;" />
        <div class="col-md-8">
            <form method="POST" action="">
                <div class="form-inline">
                    <input type="search" class="form-control" name="employee_name" value="<?php echo isset($_POST['employee_name']) ? $_POST['employee_name'] : '' ?>" placeholder="Search by name or event name" />
                    <button class="btn btn-success" name="search">Search</button>
                </div>
            </form>
            <form method="POST" action="">
                <input type="date" name="event_date" id="event_date" value="<?php echo isset($_POST['event_date']) ? $_POST['event_date'] : '' ?>">
                <button class="btn btn-success" name="search-date">Search</button>
            </form>
            <br /><br />
            <?php include 'search.php'?>
        </div>
    </div>
</body>
</html>