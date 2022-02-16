<!-- View All DSA Records -->
<table class="table table-hover ">
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
			<th scope="col">Name</th>
			<th scope="col">Mobile No.</th>
			<th scope="col">Gender</th>
			<th scope="col">Entered By</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
            <?php 
            $query = "SELECT * FROM dsa_records";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)) {  ?>

            <!--<td><?php //echo $row['post_id'] ?></td>-->
            <td><?= $row['date']; ?></td>
            <td><?= $row['time']; ?></td>
            <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
            <td><?= $row['mobileno']; ?></td>
            <td><?= $row['gender']; ?></td>
            <td><?= $row['entered_by']; ?></td>

			<td>
                <a href="./records.php?opt=edit_record&edit_record=<?= $row['id'] ?>" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>
				<a href="./records.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
			</td>
		</tr>
        <?php } ?>
	</tbody>
</table>

<?php 
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM dsa_records WHERE id = '$delete_id'";
        $result = mysqli_query($conn, $query);
        // if($result) {
        //     unlink("../assets/img/blog/$post_img");
        //     header("location: posts.php");
        // }
    }
?>