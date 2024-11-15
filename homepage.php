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
    
    #research-container {
            display: flex;
            flex-wrap: wrap;
        }
        .research-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }
        .research-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .read-more {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
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
    <br>
    <h1>Research Suggestions</h1>
    <div id="research-container"></div>
</div>

<script>
    // Add a research card to the container
    function addResearchCard(title, date, abstract, imageUrl) {
    const container = document.getElementById('research-container');
    const card = document.createElement('div');
    
    // Set a default image if `imageUrl` is empty
    const imageSrc = imageUrl ? imageUrl : '../img/neust_logo.png';
    
    card.className = 'research-card';
    card.innerHTML = `
        <img src="UploadIMG/${imageSrc}" alt="Research Image" class="research-image">
        <h2>${title}</h2>
        <p><strong>Year:</strong> ${date}</p>
        <p>${abstract}</p>
        <a href="#" class="read-more">Read More</a>
    `;
    container.appendChild(card);
}


    // Suggest research papers based on a query
    function suggestResearchPapers(researchPapers, query, desiredCount) {
        const suggestions = researchPapers.filter(paper =>
            (paper.Title && paper.Title.toLowerCase().includes(query.toLowerCase()))
        );

        if (suggestions.length < desiredCount) {
            const remainingCount = desiredCount - suggestions.length;
            const randomPapers = researchPapers
                .filter(paper => !suggestions.includes(paper))
                .sort(() => Math.random() - 0.5)
                .slice(0, remainingCount);
            suggestions.push(...randomPapers);
        }

        return suggestions.slice(0, desiredCount);
    }

    // Fetch and display research suggestions from the API
    function fetchResearchSuggestions() {
        fetch('backend/Suggestresearch.php')
            .then(response => response.json())
            .then(researchPapers => {
                const searchQuery = 'dynamic'; // Set query based on requirements
                const desiredCount = 10; // Number of papers to display
                const suggestedPapers = suggestResearchPapers(researchPapers, searchQuery, desiredCount);

                const container = document.getElementById('research-container');
                container.innerHTML = ''; // Clear previous content

                suggestedPapers.forEach(paper => {
                    addResearchCard(paper.Title, paper.date, paper.Abstract, paper.ImageName);
                });

                if (suggestedPapers.length === 0) {
                    container.innerHTML = '<p>No research papers found for your query.</p>';
                }
            })
            .catch(error => console.error('Error fetching research papers:', error));
    }

    // Fetch research suggestions on page load
    fetchResearchSuggestions();
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