<?php 
    // Delete User from db
    if(isset($_GET['delete'])) {
        $user_ID = $_GET['delete'];
        $userObj->deleteUser($user_ID);
    }

    // Change user role to admin
    if(isset($_GET['admin'])) {
        $admin_id = $_GET['admin'];
        $userObj->changeToAdmin($admin_id);
    }

    // Change user role to customer
    if(isset($_GET['customer'])) {
        $customer_id = $_GET['customer'];
        $userObj->changeToCustomer($customer_id);
    }
?>

<!-- View All Posts -->
<table class="table table-hover ">
	<thead>
		<tr>
			<th>Sn</th>
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
                $sn = 1;
                $users = $userObj->getUsers();
                if($users !== false) :
                    foreach ($users as $user) :
            ?>
            <td><?= $sn ?></td> 
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
                <a href="./users.php?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="confirm('Are you sure want to delete this user')"><span class="fa fa-trash"></span></a>
			</td>
		</tr>
        <?php
            $sn++;
            endforeach; 
            endif;
        ?>
	</tbody>
</table>