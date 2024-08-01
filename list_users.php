<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <button class="btn btn-primary my-5" onclick="window.location.href='user_form.php'">Add User</button>
        <h2>Users List</h2>
        
        <?php
        $result = $conn->query("SELECT * FROM users");
        if ($result->num_rows > 0) {
        ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['mobile']}</td>
                            <td>{$row['email']}</td>
                            <td><img src='{$row['profile_picture']}' alt='Profile Picture' width='50'></td>
                            <td>
                                <a href='update_user.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                                <a href='javascript:void(0);' onclick='confirmDelete({$row['id']})' class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p>No data available.</p>";
        }
        ?>
    </div>
    <script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = "delete_user.php?id=" + id;
        }
    }
    </script>
</body>
</html>
