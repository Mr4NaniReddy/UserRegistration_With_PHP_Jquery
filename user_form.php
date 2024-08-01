<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">

     
</head>
<body>
    <div class="container mt-5">
        <h2>User Registration</h2>
        <form id="userForm" action="add_user.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
                <div class="invalid-feedback">Please enter your first name.</div>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
                <div class="invalid-feedback">Please enter your last name.</div>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile">
                <div class="invalid-feedback">Please enter your mobile number.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="form-group password-container">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>
            <div class="form-group password-container">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <i class="fas fa-eye eye-icon" id="toggleConfirmPassword"></i>
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>


            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" accept="image/*" name="profile_picture">
                <div class="invalid-feedback">Please upload a profile picture</div>
                <img id="imagePreview" src="#" alt="Profile Picture Preview" style="display: none; max-width: 100px; margin-top: 10px;" />

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary my-3" onclick="window.location.href='index.php'">Back to Home</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/script.js"></script>

</body>
</html>
