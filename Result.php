<?php
// require_once 'verifier.php';

//     if(!Verifyuser()){
//         header("Location: homepage.php");
//         exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>homepage page</title>
</head>
<style>        /* Modal background */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        z-index: 10;
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], select, input[type="date"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .modalbutton {
        padding: 10px 15px;
        margin: 5px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .modalbutton[type="submit"] {
        background-color: #4CAF50;
        color: white;
    }

    #research-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
            }

            .research-card {
                background: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 300px;
                transition: transform 0.2s;
                text-align: center;
            }

            .research-card:hover {
                transform: scale(1.05);
            }

            .research-image {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin-bottom: 15px;
            }

            .research-title {
                font-size: 18px;
                margin: 0;
                color: #333;
            }

        .research-author, .research-year {
            font-size: 14px;
            color: #555;
        }

        .research-description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .read-more {
            display: inline-block;
            padding: 8px 12px;
            margin-top: 10px;
            background-color: #6795c9;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .read-more:hover {
            background-color: #1060c9;
            color:white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #research-container {
                flex-direction: column;
                align-items: center;
            }
            
            .research-card {
                width: 100%;
                max-width: 500px;
            }
            .norDiv{
                background: rgba(red, green, blue, 0.06);
                padding: 3em;
                border-radius: 20px;
                text-align: center;
                position:sticky;
                transition: all 0.2s ease-in-out;
                max-width: 1100px; /* Set maximum width */
                width: 90%; /* Set width to a percentage */
                margin: 0 auto; /* Center the form horizontally */
                margin-top: 1%;
                z-index: 2; /* Lowest layer */
}
        }
</style>
<?php
include 'modal/header.php';
?>


<body>
<div class="contentor">
    
    <div class="input-group mb-3" style="padding:1rem 15% 0 15%; @media screen and (max-width: 600px) {padding:1rem 5% 0 5%;} ">
        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-secondary" type="button"><span class="mdi--search"></span></button>
        <button class="btn btn-outline-secondary" type="button" id="openModalBtn"><span class="carbon--search-advanced"></span></button>        
    </div>
       
   <!-- modal -->
    <div id="advancedSearchModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Advanced Search</h2>
                <form id="searchForm">
                    <div class="form-group">
                        <label for="keyword">Keyword:</label>
                        <input type="text" id="keyword" name="keyword">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select id="category" name="category">
                            <option value="">Select Category</option>
                            <option value="books">Books</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothing">Clothing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dateRange">Date Range:</label>
                        <input type="date" id="startDate" name="startDate">
                        to
                        <input type="date" id="endDate" name="endDate">
                    </div>
                    <button type="submit" class="modalbutton">Search</button>
                    <button type="button" id="clearBtn" class="modalbutton">Clear</button>
                </form>
            </div>
        </div>



    <section id="research-container">
          
    </section>
</div>
<script>
       

        // Example of dynamically adding a card
        function addResearchCard(title, author, year, description, imageUrl) {
            const container = document.getElementById('research-container');
            const card = document.createElement('div');
            card.className = 'research-card';
            card.innerHTML = `
                <img src="${imageUrl}" alt="Research Image" class="research-image">
                <h2 class="research-title">${title}</h2>
                <p class="research-author">Author: ${author}</p>
                <p class="research-year">Year: ${year}</p>
                <p class="research-description">${description}</p>
                <a href="#" class="read-more">Read More</a>
            `;
            container.appendChild(card);
        }

        // Example usage of the function
        addResearchCard('Dynamic Paper Title', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'https://via.placeholder.com/300x200');
    </script>
    <script src="modal/modal.js"></script>
</body>
</html>
