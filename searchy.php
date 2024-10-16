<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .card {
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }
        .card:hover {
            transform: scale(1.05); /* Slightly enlarge card on hover */
        }
        .research-image {
            height: 200px; /* Set a fixed height for images */
            object-fit: cover; /* Crop image to fit */
        }
        .card-title {
            font-size: 1.5rem; /* Increase title font size */
            font-weight: bold; /* Make title bold */
        }
        .card-text {
            font-size: 1rem; /* Standard font size for text */
        }
        .btn {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text color for button */
        }
        .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .alert {
            margin-top: 20px; /* Spacing for alerts */
        }
    </style>
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
                } else {
                    data.forEach(item => {
                        let researchers = item.Researchers.map(res => res.name).join(', ');
                        let panels = item.Panels.map(pan => pan.name).join(', '); // Use item.Panels if it exists

                        $('#results').append(`
                            <div class="card mb-3">
                                <img src="${item.ImageUrl === '' ? 'img/neust_logo.png' : 'UploadIMG/'+ item.ImageUrl}" class="card-img-top research-image" alt="Research Image">
                                <div class="card-body">
                                    <h5 class="card-title">${item.Title}</h5>
                                    <p class="card-text"><strong>Researchers:</strong> ${researchers}</p>
                                    <p><strong>Panels:</strong> ${panels}</p>
                                    <p class="card-text"><strong>Year:</strong> ${item.Year}</p>
                                    <p class="card-text">${item.Description}</p>
                                    <a href="ResearchView?researchID=${item.ID}" class="btn">Read More</a>
                                </div>
                            </div>
                        `);
                    });
                }
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
