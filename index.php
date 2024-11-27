
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom.css" rel="stylesheet"> 
    <style>body {
    /* background-image: url('../img/IMG_20231004_151448.jpg'); */
    background-size: cover;
    background-position: center;
    width: 100vw;
    height: 100vh;
}</style>
</head>
<body>

<div class="lagayan">
     

                    <form action="backend/try.php" method="GET">
                       <h4>NEUST-MGT Research Repository</h4>    
                       <br>
                       <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" required>
                        <label for="username">Email</label>
                      </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required >
                        <label for="password">Password</label>
                        
                        
                      </div>
                      <input type="checkbox" id="showPassword">
        <label for="showPassword">Show Password</label>
                      <br> 
                        <button type="submit" class="btn btn-primary buttonclean">Login</button>
                        <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>Login failed. Please try again.</p>";
    }
    ?>        
                    </form>
                    <script>
        // Get references to the password input and checkbox
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        // Add event listener for the checkbox to toggle password visibility
        showPasswordCheckbox.addEventListener('change', function() {
            // Check if the checkbox is checked
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text'; // Show password as text
            } else {
                passwordInput.type = 'password'; // Hide password
            }
        });
    </script>
</body>
</html>
