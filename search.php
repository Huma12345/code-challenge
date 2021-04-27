<?php

$sql_qry = "SELECT SUM(participation_fee) AS count
    FROM codechallenge";

$duration = $conn->query($sql_qry);
$record = $duration->fetch(PDO::FETCH_ASSOC);
$total = $record['count'];

if(ISSET($_POST['search'])){

?>

    <table class="table table-bordered">
        <thead class="alert-info">
            <tr>
                <th>Participation ID</th>
                <th>Employee Name</th>
                <th>Employee Mail</th>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Participation Fee</th>
                <th>Event Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $keyword = $_POST['employee_name'] ;
                $query = $conn->prepare("SELECT * FROM codechallenge WHERE employee_name LIKE '%$keyword%' or event_name LIKE '%$keyword%'");
                $query->execute();
                while($row = $query->fetch()){
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['participation_id']) ?></td>
                <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                <td><?php echo htmlspecialchars($row['employee_mail']); ?></td>
                <td><?php echo htmlspecialchars($row['event_id']); ?></td>
                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                <td><?php echo htmlspecialchars($row['participation_fee']); ?></td>
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="5"><strong>Total</strong></td>
                <?php
                    $results = $conn->prepare("SELECT sum(participation_fee) FROM codechallenge WHERE employee_name LIKE '%$keyword%' or event_name LIKE '%$keyword%'");
                    $results->execute();
                    for($i=0; $rows = $results->fetch(); $i++){?>
                        <td><strong><?= ROUND($rows['sum(participation_fee)'], 2) ?></strong></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

<?php } elseif(ISSET($_POST['search-date'])) { ?>
    <table class="table table-bordered">
        <thead class="alert-info">
            <tr>
                <th>Participation ID</th>
                <th>Employee Name</th>
                <th>Employee Mail</th>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Participation Fee</th>
                <th>Event Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $keyword = $_POST['event_date'] ;
                $query = $conn->prepare("SELECT * FROM codechallenge WHERE event_date LIKE '%$keyword%'");
                $query->execute();
                while($row = $query->fetch()){
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['participation_id']) ?></td>
                <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                <td><?php echo htmlspecialchars($row['employee_mail']); ?></td>
                <td><?php echo htmlspecialchars($row['event_id']); ?></td>
                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                <td><?php echo htmlspecialchars($row['participation_fee']); ?></td>
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="5"><strong>Total</strong></td>
                <?php
                    $results = $conn->prepare("SELECT sum(participation_fee) FROM codechallenge WHERE event_date LIKE '%$keyword%'");
                    $results->execute();
                    for($i=0; $rows = $results->fetch(); $i++){?>
                        <td><strong><?= ROUND($rows['sum(participation_fee)'], 2) ?></strong></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

<?php } else { ?>
    <table class="table table-bordered">
		<thead class="alert-info">
			<tr>
                <th>Participation ID</th>
                <th>Employee Name</th>
                <th>Employee Mail</th>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Participation Fee</th>
                <th>Event Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = $conn->prepare("SELECT * FROM codechallenge");
				$query->execute();
				while($row = $query->fetch()){
			?>
			<tr>
                <td><?php echo htmlspecialchars($row['participation_id']) ?></td>
                <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                <td><?php echo htmlspecialchars($row['employee_mail']); ?></td>
                <td><?php echo htmlspecialchars($row['event_id']); ?></td>
                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                <td><?php echo htmlspecialchars($row['participation_fee']); ?></td>
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
			</tr>
			<?php
				}
			?>
            <tr>
                <td colspan="5"><strong>Total</strong></td>
                <td><strong><?= ROUND($total, 2) ?></strong></td>
            </tr>
		</tbody>
	</table>

<?php } ?>