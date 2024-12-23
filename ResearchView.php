
<!DOCTYPE html>
<html>
    
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>PDF File Upload</title>
</head>
<style>
.heart-button {
  width: 50px;
  height: 50px;
  background-color: transparent; /* Make the background transparent */
  border: none;
  border-radius: 50%; /* Makes the button circular */
  cursor: pointer;
  display: inline-flex;
  justify-content: center;
  align-items: center;
}

.HEART {
  display: inline-block;
  width: 2rem; /* Adjust size as needed */
  height: 2rem;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23ff0000' d='m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z'/%3E%3C/svg%3E");
  background-color: pink;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}

.heart-button:hover .HEART {
  background-color: orange; /* Change heart color on hover */
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
        .starsDiv {
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }

        .starRATE {
            width: 24px;
            height: 24px;
            fill: #ddd; /* Default color */
        }

        .starRATE.filled {
            fill: gold; /* Fully filled star */
        }

        .starRATE.partial {
            fill: gold;
            clip-path: inset(0 calc(100% - var(--percent)) 0 0); /* Controls the fill of the partial star */
        }
        .research-fullview {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .research-title {
            font-size: 2.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .research-year,
        .research-description,
        .research-researchers,
        .research-panels,
        .research-tags,
        .research-keywords {
            font-size: 1.1em;
            margin: 12px 0;
            color: #555;
        }

        .research-title,
        .research-year,
        .research-description,
        .research-researchers {
            font-weight: bold;
        }

        .research-fullview p {
            line-height: 1.6;
        }

        .read-more {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 1em;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .read-more:hover {
            background-color: #0056b3;
        }

        .research-image {
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            border-radius: 4px;
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

    require 'backend/dblogin.php';
    
    try {
        // Query to get count and average
        $query = "SELECT COUNT(*) AS count, AVG(`Rate`) AS ratercount FROM `studentresearchratetbl` WHERE `ResearchID` = :researchID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':researchID' => $researchID]);
    
        // Fetch result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalRatings = $result['count'];
        $averageRating = round($result['ratercount'], 1); // Round to 1 decimal place
        $exactRatingPercentage = ($result['ratercount'] / 5) * 100; // Calculate exact percentage
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    

?>




<?php   include 'modal/header.php'; 
        ?>
<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">
        

            <div class="research-fullview">
                <h4>Add to Favorite</h4>


                <button class="heart-button" id="favoriteButton">
                        <div class="HEART" id="heart"> </div>
                </button>

        
                <input type="hidden" name="UID" id="UID" value="<?php echo $email ?>"> <!-- Replace with dynamic student ID -->
                <input type="hidden" name="ResearchID" id="ResearchID" value="<?php echo $researchID ?> "> <!-- Replace with dynamic research ID -->
        


                <div>
                    <div id="researchDetails" class="mt-4"></div>
                </div>

    <p>Total Ratings: <?= $totalRatings ?></p>
    <p>Average Rating: <?= $averageRating ?> / 5</p>
                <div class="starsDiv">
                    <?php
                    $wholeStars = floor($averageRating); // Number of full stars
                    $fraction = $averageRating - $wholeStars; // Remaining fraction of the last star
                    $totalStars = 5; // Total stars to display

                    // Render full stars
                    for ($i = 1; $i <= $wholeStars; $i++) {
                        echo '<svg class="starRATE filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    }

                    // Render partial star (if applicable)
                    if ($fraction > 0) {
                        $percentage = $fraction * 100; // Convert fraction to percentage
                        echo '<svg class="starRATE partial" style="--percent: ' . $percentage . '%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    }

                    // Render empty stars
                    for ($i = $wholeStars + ($fraction > 0 ? 1 : 0); $i < $totalStars; $i++) {
                        echo '<svg class="starRATE" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    }
                    ?>
                </div>
                    <h4>Rate the Research</h4>
                    <div class="star-rating" id="starRating">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <button id="submitRating" class="btn btn-primary btn-lg" style="margin-top: 20px;">Submit Rating</button>
            </div>
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
                            
                                <h1 class="research-title">${research.Title}</h1>
                                <p class="research-year"><strong>Year:</strong> ${research.Year || 'N/A'}</p>
                                <p class="research-description"><strong>Description:</strong> ${research.Description || 'No description'}</p>
                                <p class="research-researchers"><strong>Researchers:</strong> ${researchers}</p>
                                <p class="research-panels"><strong>Panels:</strong> ${Panels}</p>
                                <p class="research-tags"><strong>Tags:</strong> ${tags}</p>
                                <p class="research-keywords"><strong>Keywords:</strong> ${keywords}</p>
                                <a href="try?FILE=${research.FILE}" class="read-more">Read Full Research</a>
                                <img src="${research.ImageUrl === '' ? 'img/neust_logo.png' : 'UploadIMG/'+ research.ImageUrl}" alt="Research Image" class="research-image">
                            

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
                        Swal.fire({
                            icon: 'success',
                            title: 'Rating submitted successfully!',
                            showConfirmButton: true
                        }).then(() => {
                            // Reload the page after the success message is closed
                            window.location.reload();
                        });
                    })
                .catch((error) => {
                    console.error('Error:', error);
                });
            } else {
                Swal.fire({
                icon: 'warning',
                title: 'Please select a rating before submitting.',
                showConfirmButton: true
            });
                
            }
        });

        // On page load, fetch and display previous rating
        const UID = document.getElementById('UID').value;
        const ResearchID = document.getElementById('ResearchID').value;
        fetchPreviousRating(UID, ResearchID); // Fetch the previous rating for this user and research
    </script>
        <script>
                const studentId = <?php echo $email; ?>;
                const id = <?php echo $researchID; ?>;

                // Function to check favorite status
                function checkFavorite() {
            fetch('hahaha.php', { // Replace with your PHP script URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'studentId': studentId, // Ensure studentId is defined
                    'id': id, // Ensure id is defined
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    const heartButton = document.getElementById('favoriteButton');
                    const heart = document.getElementById('heart');

                    if (data.status === 1) {
                        // Item is favorited
                        heart.style.display = 'block'; // Show heart
                        heartButton.style.backgroundColor = 'red'; // Change button color to red
                    } else {
                        // Item is not favorited
                        heart.style.display = 'block'; // Hide heart
                        heartButton.style.backgroundColor = 'gray'; // Change button color to gray
                    }
                })
                .catch((error) => {
                    console.error('Error:', error.message);
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

</body>
</html>
