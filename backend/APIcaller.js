

        //makeStudent
document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object from the form
    var formData = new FormData(this);

    // Send the form data to the PHP API using fetch
    fetch('backend/adminaccessApi.php', { // The URL of the PHP file that processes the form data
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        // Handle the response from the PHP API
        if (data.success) {
            // Show success alert
            swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Clear the form inputs after closing the alert
                document.getElementById('myForm').reset();
            });
        } else {
            // Show error alert
            swal.fire({
                title: 'Error!',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        }
    })
    .catch(error => {
        // Handle any errors from the API or network
        console.error('Error:', error);
        swal.fire({
            title: 'Error!',
            text: 'Already in Database',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    });
});