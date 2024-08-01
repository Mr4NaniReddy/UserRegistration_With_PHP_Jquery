<?php
include 'db.php';

$update_successful = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $profile_picture = '';

    if ($_FILES['profile_picture']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_picture = $target_file;
    } else {
        $profile_picture = $_POST['current_profile_picture'];
    }

    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, mobile = ?, email = ?, profile_picture = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $mobile, $email, $profile_picture, $id);

    if ($stmt->execute()) {
        // $update_successful = true;
        header("Location: list_users.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update User</h2>
        <form id="userForm1" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                <div class="invalid-feedback">Please enter your first name.</div>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
                <div class="invalid-feedback">Please enter your last name.</div>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>">
                <div class="invalid-feedback">Please enter your mobile number.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" readonly>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
                <div id="newPhotoContainer" style="display: none; margin-top: 5px">
                    <h6>New Photo</h6>
                    <img id="imagePreview" src="#" alt="Profile Picture Preview" style="max-width: 100px; margin-top: 10px;" />
                </div>                
                <br>
                <h6>Existing Photo</h6>
                <input type="hidden" name="current_profile_picture" value="<?php echo $user['profile_picture']; ?>">
                <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="100">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
   $(document).ready(function () {



    $('#profile_picture').change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#newPhotoContainer').show();
                $('#imagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
       
        }
    });

    $('#userForm1').submit(function (event) {
        var isValid = true;

        if ($('#first_name').val().trim() === '') {
            isValid = false;
            $('#first_name').addClass('is-invalid');
            $('#first_name').next('.invalid-feedback').text('Please enter your first name.');
        } else {
            $('#first_name').removeClass('is-invalid');
            $('#first_name').next('.invalid-feedback').text('');
        }

        if ($('#last_name').val().trim() === '') {
            isValid = false;
            $('#last_name').addClass('is-invalid');
            $('#last_name').next('.invalid-feedback').text('Please enter your last name.');
        } else {
            $('#last_name').removeClass('is-invalid');
            $('#last_name').next('.invalid-feedback').text('');
        }

        var email = $('#email').val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            $('#email').addClass('is-invalid');
            $('#email').next('.invalid-feedback').text('Please enter a valid email address.');
        } else {
            $('#email').removeClass('is-invalid');
            $('#email').next('.invalid-feedback').text('');
        }

        var mobile = $('#mobile').val();
        var mobilePattern = /^[0-9]{10}$/;
        if (!mobilePattern.test(mobile)) {
            isValid = false;
            $('#mobile').addClass('is-invalid');
            $('#mobile').next('.invalid-feedback').text('Please enter a valid mobile number.');
        } else {
            $('#mobile').removeClass('is-invalid');
            $('#mobile').next('.invalid-feedback').text('');
        }

        if (!isValid) {
            event.preventDefault();
        }
        });
    });
        //  ?php if ($update_successful): ?>
        //     alert("User updated successfully!");
        //     window.location.href = 'list_users.php';
        // ?php endif; ?>
</script>
</body>
</html>
