<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f7f7f7;
        }
        .favorite-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        .favorite-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .favorite-item h3 {
            margin: 0 10px;
            flex-grow: 1;
        }
        .favorite-item button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .favorite-item button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Your Favorites</h1>
    <div id="favorites-container"></div>

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

                        favoriteDiv.innerHTML = `
                            <img src="${imageUrl}" alt="Favorite Image">
                            <h3>${item.Title}</h3>
                            <button onclick="removeFavorite(${item.ResearchID})">Remove</button>
                        `;
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
