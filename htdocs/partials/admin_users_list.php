<!-- Table to show all the rides that are currently available in the
    advertise table -->
    <h3 style="color:white;">Users in database:</h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Email</th>
            <th scope='col'>Username</th>
            <th scope='col'>Password</th>
            <th scope='col'>IsAdmin</th>
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_admin_user_list()");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["u_email"]."</td>
            <td>".$row["u_name"]."</td>
            <td>".$row["u_password"]."</td>
            <td>".$row["isadmin"]."</td>
            <td>
                <a href='/demo/admin_update_user.php?email=".$row["u_email"]."'>
                    <button class='btn btn-outline-primary'>
                        Edit user
                    </button>
                </a>
            </td>
            <td>
                <a href='/demo/actions/delete_user.php?email=".$row["u_email"]."'>
                    <button class='btn btn-outline-danger'>
                        Delete user
                    </button>
                </a>
            </td>
            </tr>";
        $index++;
    }
?>

    </tbody>
</table>