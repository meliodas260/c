<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert with PHP</title>
    <!-- Include SweetAlert2 from CDN -->
   
<body>

    <h1>SweetAlert Example with PHP</h1>

    <?php
    // Simulate a PHP boolean variable
    $showAlert = "sige"; // Change this to false to avoid showing the alert

    // Check if the boolean is true
    if ($showAlert == "sige") {
        // Output JavaScript code to trigger the SweetAlert
        echo "
        <script>
            swal.fire({
                title: 'PHP Alert!',
                text: 'This alert is triggered by a PHP variable.',
                icon: 'success',
                confirmButtonText: 'Cool'
            });
        </script>
        ";
    }
    ?>

</body>
</html>
