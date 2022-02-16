<!-- View All Posts -->
<table class="table table-hover ">
	<thead>
		<tr>
			<th>ID</th>
			<th>Profile Img</th>
			<!-- <th>UserName</th> -->
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
            <th>Mobile #</th>
			<th>Role</th>
			<!-- <th>Date</th> -->
			<th>Admin</th>
			<th>Customer</th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
            <?php 
            $query = "SELECT * FROM peri_users";
            $users = mysqli_query($conn, $query);
            while($user = mysqli_fetch_assoc($users)) {  ?>

    
                <td><?= $user['id'] ?></td> 
                <td><img width="50" height="50" class="img-responsive" src="./assets/img/user/<?= $user['profile_image'] ?>"></td>
                <!-- <td><?php  //$row['user_name'] ?></td> -->
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td> 
                <td><?= $user['email'] ?></td>
                <td><?= $user['mobilenumber'] ?></td>
                <td><?= $user['user_role'] ?></td>
                <!-- <td><?php //$row['user_date'] ?></td> -->
                <td class="text-center"><a href="./users.php?admin=<?= $user['id'] ?>" class="btn btn-sm btn-primary"><span class="fa fa-user"></span></a></td>
                <td class="text-center"><a href="./users.php?customer=<?= $user['id'] ?>" class="btn btn-sm btn-info btn-users"><span class="fa fa-users"></span></a></td>
			    <td class="text-center">
                    <a href="./users.php?opt=edit_user&edit_user=<?= $user['id'] ?>" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>
                    <a href="./users.php?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
			    </td>
		</tr>
        <?php   }   //end while loop ?>
	</tbody>
</table>

<?php 
    // Delete User from db
    if(isset($_GET['delete'])) {
        $user_ID = $_GET['delete'];
        $user_query = "DELETE FROM peri_users WHERE id = '$user_ID'";
        $result = mysqli_query($conn, $user_query);
        if($result) {
            header("location: users.php");
        }
    }

    // Change user role to admin
    if(isset($_GET['admin'])) {
        $admin_id = $_GET['admin'];
        $sql_users = "UPDATE peri_users SET user_role = 'admin' WHERE id = '$admin_id'";
        $sql_result = mysqli_query($conn, $sql_users);

        if($sql_result) {
            header('location: users.php');
        }
    }

    // Change user role to customer
    if(isset($_GET['customer'])) {
        $customer_id = $_GET['customer'];
        $sql_users = "UPDATE peri_users SET user_role = 'customer' WHERE id = '$customer_id'";
        $sql_result = mysqli_query($conn, $sql_users);

        if($sql_result) {
            header('location: users.php');
        }
    }
?>