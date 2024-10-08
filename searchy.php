<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Search Research</h1>
    
    <div id="results" class="mt-4"></div>
</div>

<script>
// Function to get query parameters from the URL
function getQueryParams() {
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    return {
        Title: urlParams.get('Title') || '',
        Tag: urlParams.get('Tag') || '',
        Course: urlParams.get('Course') || '',
        Keyword: urlParams.get('Keyword') || ''
    };
}

$(document).ready(function() {
    // Get parameters from the URL or session
    const searchParams = getQueryParams();

    // Send AJAX request automatically on page load
    $.ajax({
        url: 'backend/SearchAPI.php', // The PHP file you created
        type: 'POST',
        data: searchParams,
        dataType: 'json',
        success: function(data) {
            $('#results').empty(); // Clear previous results

            if (data.error) {
                $('#results').append(`
                    <div class="alert alert-danger">
                        <strong>Error:</strong> ${data.error}
                    </div>
                `);
            } else {
                if (data.length === 0) {
                    $('#results').append(`
                        <div class="alert alert-info">
                            No results found.
                        </div>
                    `);
                }
                data.forEach(item => {
                    let researchers = item.Researchers.map(res => res.name).join(', ');
                    let Panels = item.Researchers.map(res => res.name).join(', ');
                    $('#results').append(`
                        <div class="card mb-3">
                            <img src="${item.ImageUrl}" class="card-img-top" alt="Research Image">
                            <div class="card-body">
                                <h5 class="card-title">${item.Title}</h5>
                                <p class="card-text"><strong>Researchers:</strong> ${researchers}</p>
                                <p><strong>Panels:</strong> ${Panels}</p>
                                <p class="card-text"><strong>Year:</strong> ${item.Year}</p>
                                <p class="card-text">${item.Description}</p>
                            </div>
                        </div>
                    `);
                });
            }
        },
        error: function(jqXHR) {
            // Use status code to provide more detailed error
            let errorMessage = jqXHR.status + ': ' + (jqXHR.responseJSON && jqXHR.responseJSON.error ? jqXHR.responseJSON.error : jqXHR.statusText);
            $('#results').append(`
                <div class="alert alert-danger">
                    <strong>Error:</strong> ${errorMessage}
                </div>
            `);
        }
    });
});
</script>

</body>
</html>
