// modal.js

// Get modal element
const modal = document.getElementById('advancedSearchModal');

// Get open modal button
const openModalBtn = document.getElementById('openModalBtn');

// Get close button
const closeBtn = document.getElementsByClassName('close')[0];

// Get clear button
const clearBtn = document.getElementById('clearBtn');

// Open modal
openModalBtn.onclick = function() {
    modal.style.display = 'block';
}

// Close modal
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

// Clear form inputs
clearBtn.onclick = function() {
    document.getElementById('searchForm').reset();
}
