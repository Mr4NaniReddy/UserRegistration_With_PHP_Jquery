    $(document).ready(function() {
        
        $('#profile_picture').change(function () {
            readURL(this);
        });
    
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').show();
                }
    
                reader.readAsDataURL(input.files[0]); 
            }
        }
        $('#togglePassword').click(function () {
            var passwordField = $('#password');
            var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    
        $('#toggleConfirmPassword').click(function () {
            var confirmPasswordField = $('#confirm_password');
            var type = confirmPasswordField.attr('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
        
        $('#userForm').submit(function(event) {
            var valid = true;

           
        
            
            $('.form-control').each(function() {
                if ($(this).val() === '') {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if ($('#first_name').val().trim() === '') {
                valid = false;
                $('#first_name').addClass('is-invalid');
                $('#first_name').next('.invalid-feedback').text('Please enter your first name.');
            } else {
                $('#first_name').removeClass('is-invalid');
                $('#first_name').next('.invalid-feedback').text('');
            }
    
            if ($('#last_name').val().trim() === '') {
                valid = false;
                $('#last_name').addClass('is-invalid');
                $('#last_name').next('.invalid-feedback').text('Please enter your last name.');
            } else {
                $('#last_name').removeClass('is-invalid');
                $('#last_name').next('.invalid-feedback').text('');
            }

            var email = $('#email').val();
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                valid = false;
                $('#email').addClass('is-invalid');
                $('#email').next('.invalid-feedback').text('Please enter a valid email address.');
            } else {
                $('#email').removeClass('is-invalid');
                $('#email').next('.invalid-feedback').text('');
            }

            var mobile = $('#mobile').val();
            var mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                valid = false;
                $('#mobile').addClass('is-invalid');
            } else {
                $('#mobile').removeClass('is-invalid');
            }
            
            var password = $('#password').val();
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
            if (!passwordPattern.test(password)) {
                valid = false;
                $('#password').addClass('is-invalid');
                $('#password').next('.invalid-feedback').text('Password must be at least 6 characters long and include an uppercase letter, lowercase letter, number, and special character.');
            } else {
                $('#password').removeClass('is-invalid');
                $('#password').next('.invalid-feedback').text('');
            }

            var confirmPassword = $('#confirm_password').val();
            if (password !== confirmPassword) {
                valid = false;
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').next('.invalid-feedback').text('Passwords do not match.');
            } else {
                $('#confirm_password').removeClass('is-invalid');
                $('#confirm_password').next('.invalid-feedback').text('');
            }


            
            var file = $('#profile_picture')[0].files[0];
            if (file) {
                var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if ($.inArray(file.type, validImageTypes) === -1) {
                    valid = false;
                    $('#profile_picture').addClass('is-invalid');
                    $('#profile_picture').next('.invalid-feedback').text('Please upload a valid image file (JPEG, PNG, GIF).');
                } else {
                    var maxSize = 100 * 1024;
                    if (file.size > maxSize) {
                        valid = false;
                        $('#profile_picture').addClass('is-invalid');
                        $('#profile_picture').next('.invalid-feedback').text('Image file size should be 100 KB or less.');
                    } else {
                        $('#profile_picture').removeClass('is-invalid');
                        $('#profile_picture').next('.invalid-feedback').text('');
                    }
                }
            } else {
                valid = false;
                $('#profile_picture').addClass('is-invalid');
                $('#profile_picture').next('.invalid-feedback').text('Please upload a profile picture.');
            }
            
            if (!valid) {
                event.preventDefault();
            }
        });
    });
