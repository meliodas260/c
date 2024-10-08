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
        .flexer {
            padding-top:2rem;
            display: flex;
            flex-wrap: wrap;
        }

        .half {
            flex: 1; /* Each child will take up equal space */
            padding: 10px;
            box-sizing: border-box; /* Include padding in the width */
        }

        .left {
            background-color: lightblue;
        }

        .right {
            background-color: lightcoral;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 600px) {
            
            .half {
            
                flex: 1 1 100%;
            
            }
            #research-container {
                flex-direction: column;
                align-items: center;
            }
            
            .research-card {
                width: 100%;
                max-width: 500px;
            }
        }

</style>
<?php
include 'modal/header.php';
?>


<body>
<div class="contentor">
    
    



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
        addResearchCard('kahit ano', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'img/neust_logo.png');
        addResearchCard('Dynamic Paper Title', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'img/neust_logo.png');
        addResearchCard('Dynamic Paper Title', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'img/neust_logo.png');
        addResearchCard('Dynamic Paper Title', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'img/neust_logo.png');
        addResearchCard('Dynamic Paper Title', 'Dynamic Author', '2024', 'This is a dynamic description added via JavaScript.', 'img/neust_logo.png');
        
    </script>
    <div class="flexer">
        <div class="half left"> 

        </div>

        <div class="half right">   
            <h2> What We Offer</h2>
            <ul>
            <li> Centralized repo: Our system provides a secure and organized space where you can upload and access research papers, theses, dissertations, and other scholarly materials. With robust search and retrieval functionalities, finding relevant research has never been easier.
                </li>
            <li> Enhanced Collaboration: Collaborate with peers and colleagues by sharing your research and accessing others’ work. Our platform supports collaborative projects, allowing you to engage with a network of researchers and contribute to the academic community.
                </li>
            </ul>
        </div>
    </div>
    


    
</body>
</html>
