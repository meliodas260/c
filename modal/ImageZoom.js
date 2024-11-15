

    // Function to fetch profile image data
    function fetchProfileImage() {
        const img = document.querySelector(".profile-picture img");
if (img) {
    img.onclick = function() {
        imageModal.style.display = "flex";
        modalImg.src = img.src;
    }
}
        fetch('backend/ProfileUpload.php', { method: 'GET' })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const profileImage = document.querySelector('.profile-picture img');
                
                // Set image if available, otherwise use default
                if (data.imageName) {
                    const imageUrl = `Profiles/${data.imageName}`;
                    profileImage.src = imageUrl;
                    profileImage.alt = "Profile Picture";
                } else {
                    profileImage.alt = "img/avatar-default-icon-1024x1024-dvpl2mz1.png";
                }
            })
            .catch(error => console.error('Error fetching profile image:', error));
    }

    // Call the function to fetch the profile image when the page loads
    document.addEventListener('DOMContentLoaded', fetchProfileImage);

    // Modal functionality
    const imageModal = document.getElementById("imageModal");
    const img = document.querySelector(".profile-picture img");
    const modalImg = document.getElementById("modalImage");
    const CloseProfilezoom = document.querySelector(".close1");

    // Display the modal on profile picture click
    document.getElementById("profilePicture").onclick = function() {
        imageModal.style.display = "flex";
        modalImg.src = img.src;
    }

    // Close the modal on close button click
    CloseProfilezoom.onclick = function() {
        imageModal.style.display = "none";
    }

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        if (event.target == imageModal) {
            imageModal.style.display = "none";
        }
    }
