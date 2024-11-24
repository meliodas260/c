// rating.js

// JavaScript function to handle the star rating rendering
function renderStarRating(researchID) {
    // Fetching the rating data from the PHP API
    fetch(`your-api-endpoint.php?researchID=${researchID}`)
        .then(response => response.json())
        .then(data => {
            // Handle the data received from the API
            const totalRatings = data.totalRatings;
            const averageRating = data.averageRating;
            const exactRatingPercentage = data.exactRatingPercentage;

            // Update the page with the data
            document.getElementById('totalRatings').textContent = totalRatings;
            document.getElementById('averageRating').textContent = averageRating;

            // Handle the star rendering
            const starsDiv = document.getElementById('starsDiv');
            const wholeStars = Math.floor(averageRating);
            const fraction = averageRating - wholeStars;
            const totalStars = 5;

            // Render full stars
            starsDiv.innerHTML = ''; // Clear previous stars
            for (let i = 1; i <= wholeStars; i++) {
                starsDiv.innerHTML += '<svg class="starRATE filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
            }

            // Render partial star (if applicable)
            if (fraction > 0) {
                const percentage = fraction * 100;
                starsDiv.innerHTML += `<svg class="starRATE partial" style="--percent: ${percentage}%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>`;
            }

            // Render empty stars
            for (let i = wholeStars + (fraction > 0 ? 1 : 0); i < totalStars; i++) {
                starsDiv.innerHTML += '<svg class="starRATE" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Wait for the DOM to load, then get the researchID and call the function
document.addEventListener("DOMContentLoaded", function() {
    const researchID = document.getElementById('researchID').dataset.researchid;
    renderStarRating(researchID);
});
