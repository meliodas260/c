<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Section Count and Names</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h3>Sections Information</h3>
        <div id="sectionsCount">
            <!-- The count and section names will be displayed here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch JSON data from the server
            fetch('captapi.php') // The URL of the PHP file that returns JSON data
                .then(response => response.json())
                .then(data => {
                    // Check if data is an array
                    if (Array.isArray(data)) {
                        // Create a list of section names
                        const sectionNames = data.map(section => section.SectionName).join(', ');

                        // Display the count and section names
                        const count = data.length;
                        const sectionsCountDiv = document.getElementById('sectionsCount');
                        sectionsCountDiv.innerHTML = `
                            <p>Total Sections: ${count}</p>
                            <p>Section Names: ${sectionNames}</p>
                    ${ foreach(sectionNames)}<p> gogo </p>
                        `;
                    } else {
                        console.error('Unexpected data format:', data);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to load data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to fetch data.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
</body>
</html>
