<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>Favorite Items</title>
    <style>
        .favorite-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .favorite-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .favorite-item img {
            width: 15rem;
            height: 15rem;
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .favorite-item img:hover {
            transform: scale(1.05);
        }

        .favorite-item h3 {
            margin: 0 15px;
            flex-grow: 1;
            font-size: 1.2rem;
            color: #333;
            text-decoration: none;
        }

        .favorite-item h3:hover {
            color: #007bff;
            cursor: pointer;
        }

        .favorite-item button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .favorite-item button:hover {
            background-color: #c0392b;
        }

        .favorite-link {
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .favorite-link:hover {
            text-decoration: none;
        }

        .norDiv h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .norDiv {
            padding: 20px;
        }

    </style>
</head>
<?php
include 'modal/header.php';
?>
<body>
<div class="norDiv">
    <h1>Your Favorites</h1>
    <div id="favorites-container"></div>
</div>

<script>
    // Replace this URL with your actual API endpoint
    const apiUrl = 'backend/favorites.php';

    // Default image to use if `ImageName` is empty
    const defaultImage = 'img/neust_logo.png';

    // Fetch favorites
    function loadFavorites() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('favorites-container');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p>No favorite items found.</p>';
                    return;
                }

                data.forEach(item => {
                    const favoriteDiv = document.createElement('div');
                    favoriteDiv.className = 'favorite-item';

                    const imageUrl = item.ImageName ? `UploadIMG/${item.ImageName}` : defaultImage;

                    // Create the anchor link for each item
                    const favoriteLink = document.createElement('a');
                    favoriteLink.href = `ResearchView?researchID=${item.ResearchID}`;
                    favoriteLink.className = 'favorite-link'; // Optional: styling the link

                    favoriteLink.innerHTML = `
                        <img src="${imageUrl}" alt="Favorite Image">
                        <h3>${item.Title}</h3>
                    `;

                    // Add the link inside the favorite div
                    favoriteDiv.appendChild(favoriteLink);

                    // Create the "Remove" button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'Remove';
                    removeButton.onclick = function () {
                        removeFavorite(item.ResearchID);
                    };

                    // Add the button to the favorite div
                    favoriteDiv.appendChild(removeButton);

                    // Append the favorite div to the container
                    container.appendChild(favoriteDiv);
                });
            })
            .catch(error => {
                console.error('Error loading favorites:', error);
            });
    }

    // Remove a favorite
    function removeFavorite(researchId) {
        console.log('Sending request to remove favorite with ResearchID:', researchId);

        // Sending DELETE request with ResearchID as query parameter
        fetch(`${apiUrl}?ResearchID=${researchId}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadFavorites();
            } else {
                alert('Failed to remove favorite.');
            }
        })
        .catch(error => {
            console.error('Error removing favorite:', error);
        });
    }

    // Load favorites on page load
    document.addEventListener('DOMContentLoaded', loadFavorites);
</script>

</body>
</html>
