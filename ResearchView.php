
<!DOCTYPE html>
<html>
    
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>PDF File Upload</title>
</head>
<style>
        .heart-button {
            width: 50px;
            height: 50px;
            background-color: gray; /* Default color */
            border: none;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        .heart {
            width: 20px;
            height: 20px;
            background-color: red; /* Heart color when active */
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%); /* Simple heart shape */
            display: none; /* Hide by default */
        }
        .star-rating {
            display: flex;
            cursor: pointer;
            font-size: 30px; /* Adjust size as needed */
        }

        .star {
            color: gray; /* Default star color */
        }

        .star.selected {
            color: gold; /* Selected star color */
        }
    </style>

<body>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
if (isset($_COOKIE['Email'])) {
    // Get the value of the 'Email' cookie
    $email = $_COOKIE['Email'];
} 
    // Capture secID and researchID from URL parameters (GET request)
    $secID = "'' or 1=1 --";
    $researchID = isset($_GET['researchID']) ? $_GET['researchID'] : null;
?>




<?php   include 'modal/header.php'; 
        include 'modal/ResearcherSidebar.php';
        ?>
<div class="container mt-5">


    <h1>Research Details</h1>

  <div>
    
<button class="heart-button" id="favoriteButton">
        <div class="heart" id="heart"></div>
    </button>
    <h1>Rate the Research</h1>
    
    <input type="hidden" name="UID" id="UID" value="<?php echo $email ?>"> <!-- Replace with dynamic student ID -->
    <input type="hidden" name="ResearchID" id="ResearchID" value="<?php echo $researchID ?> "> <!-- Replace with dynamic research ID -->
    
    <div class="star-rating" id="starRating">
        <span class="star" data-value="1">★</span>
        <span class="star" data-value="2">★</span>
        <span class="star" data-value="3">★</span>
        <span class="star" data-value="4">★</span>
        <span class="star" data-value="5">★</span>
    </div>

    <button id="submitRating" style="margin-top: 20px;">Submit Rating</button>
    <script>
        const studentId = <?php echo $email; ?>;
        const id = <?php echo $researchID; ?>;

        // Function to check favorite status
        function checkFavorite() {
            fetch('hahaha.php', { // Replace with your PHP script URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'studentId': studentId,
                    'id': id
                })
            })
            .then(response => response.json())
            .then(data => {
                const heartButton = document.getElementById('favoriteButton');
                const heart = document.getElementById('heart');

                if (data.status == 1) {
                    // Item is favorited
                    heart.style.display = 'block'; // Show heart
                    heartButton.style.backgroundColor = 'red'; // Change button color to red
                } else {
                    // Item is not favorited
                    heart.style.display = 'none'; // Hide heart
                    heartButton.style.backgroundColor = 'gray'; // Change button color to gray
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
        // Call the function to check the favorite status on page load
        checkFavorite();

        document.getElementById('favoriteButton').addEventListener('click', function() {
    console.log('Button clicked');  // Log when the button is clicked

    // Define the API endpoint
    const apiUrl = 'backend/favoriteAPI.php';
    console.log('Sending AJAX request to: ' + apiUrl);  // Log the API URL

    // Make an AJAX call to the API to check and update the favorite status
    $.ajax({
        url: apiUrl,
        type: 'POST',
        data: { studentId: studentId, id: id },
        success: function(response) {
            if (response.status === 'added') {
                // Change the heart to filled when favorite is added
                document.getElementById('heart').classList.add('filled');
            } else if (response.status === 'removed') {
                // Change the heart to unfilled when favorite is removed
                document.getElementById('heart').classList.remove('filled');
            }
            // Refresh the page
window.location.reload();

        },
        error: function(error) {
            console.error('Error updating favorite status:', error);
        }
    });
});
</script>
    <div id="researchDetails" class="mt-4"></div>
    </div>
</div>



<script>
$(document).ready(function() {
    const secID = <?php echo json_encode($secID); ?>;
    const researchID = <?php echo json_encode($researchID); ?>;  // Set the specific Research ID to display
    const url = `backend/Researchdata.php`; // Backend API endpoint

    // Fetch research data from the backend
    $.ajax({
        url: url,
        type: 'POST',
        data: { SecID: secID },
        dataType: 'json',  // Expect JSON response
        success: function(data) {
            if (data.error) {
                $('#researchDetails').html(`<div class="alert alert-danger">${data.error}</div>`);
            } else {
                // Search for the specific research entry with matching researchID
                const research = data.find(item => item.ID == researchID);

                if (research) {
                    let researchers = research.Researchers.map(res => `${res.name} (${res.role})`).join(', ');
                    let Panels = research.Panels.map(res => `${res.name} (${res.role})`).join(', ');
                    let tags = research.Tags.join(', ');
                    let keywords = research.Keywords.join(', ');

                    $('#researchDetails').html(`
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${research.Title}</h5>
                                <p><strong>Year:</strong> ${research.Year || 'N/A'}</p>
                                <p><strong>Description:</strong> ${research.Description || 'No description'}</p>
                                <p><strong>Researchers:</strong> ${researchers}</p>
                                <p><strong>Panels:</strong> ${Panels}</p>
                                <p><strong>Tags:</strong> ${tags}</p>
                                <p><strong>Keywords:</strong> ${keywords}</p>
                                <a href="try?FILE=${research.FILE}">Read More </a>
                                <img src="${research.ImageUrl === '' ? 'img/neust_logo.png' : 'UploadIMG/'+ research.ImageUrl}" alt="Image" class="img-fluid">    
                            </div>
                        </div>
                    `);
                } else {
                    $('#researchDetails').html('<div class="alert alert-warning">No research data available for this ID.</div>');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#researchDetails').html(`<div class="alert alert-danger">Error: ${textStatus}</div>`);
        }
    });
});
</script>
<script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.createElement('input');
        ratingInput.type = 'hidden';
        ratingInput.name = 'rate';
        document.body.appendChild(ratingInput); // Append the rating input to the body

        // Pre-select the stars based on the past rating
        function displayPreviousRating(rating) {
            if (rating) {
                ratingInput.value = rating; // Set the previous rating value in the hidden input
                stars.forEach(s => {
                    s.classList.remove('selected');
                });
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('selected');
                }
            }
        }

        // Fetch the user's previous rating
        function fetchPreviousRating(UID, ResearchID) {
            fetch('backend/get_past_rating.php', { // Replace with your PHP script URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'UID': UID,
                    'ResearchID': ResearchID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayPreviousRating(data.rating); // Display the previous rating if it exists
                } else {
                    console.log('No previous rating found.');
                }
            })
            .catch((error) => {
                console.error('Error fetching previous rating:', error);
            });
        }

        // Add event listener to stars for selecting a new rating
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-value');
                ratingInput.value = rating; // Set the rating value

                // Update star colors
                stars.forEach(s => {
                    s.classList.remove('selected');
                });
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });

        // Submit rating
        document.getElementById('submitRating').addEventListener('click', () => {
            const UID = document.getElementById('UID').value;
            const ResearchID = document.getElementById('ResearchID').value;
            const rate = ratingInput.value;

            // Check if a rating has been selected
            if (rate) {
                fetch('rate_research.php', { // Replace with your PHP script URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'UID': UID,
                        'ResearchID': ResearchID,
                        'rate': rate
                    })
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Display the response from the server
                    window.location.reload();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            } else {
                alert('Please select a rating before submitting.');
                
            }
        });

        // On page load, fetch and display previous rating
        const UID = document.getElementById('UID').value;
        const ResearchID = document.getElementById('ResearchID').value;
        fetchPreviousRating(UID, ResearchID); // Fetch the previous rating for this user and research
    </script>
</body>
</html>
