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

    <script>
        const researchPapers = [
            { title: 'Dynamic Web Applications', author: 'Alice Smith', year: '2023', description: 'An in-depth look at web app development.', imageUrl: 'img/neust_logo.png' },
            { title: 'Machine Learning Basics', author: 'Bob Johnson', year: '2024', description: 'Introduction to machine learning concepts.', imageUrl: 'img/neust_logo.png' },
            { title: 'Advanced AI Techniques', author: 'Charlie Brown', year: '2022', description: 'Exploring the latest in artificial intelligence.', imageUrl: 'img/neust_logo.png' },
            { title: 'Understanding Data Science', author: 'David Wilson', year: '2024', description: 'A comprehensive guide to data science.', imageUrl: 'img/neust_logo.png' },
            { title: 'Web Development Trends', author: 'Eve Davis', year: '2024', description: 'Current trends in web development.', imageUrl: 'img/neust_logo.png' },
            { title: 'Cybersecurity Fundamentals', author: 'Frank Clark', year: '2023', description: 'Essential principles of cybersecurity.', imageUrl: 'img/neust_logo.png' },
            { title: 'Quantum Computing Revolution', author: 'Grace Lee', year: '2023', description: 'A look into the future of quantum computing.', imageUrl: 'img/neust_logo.png' },
            { title: 'Blockchain Technology Explained', author: 'Henry Zhang', year: '2024', description: 'Understanding blockchain and its applications.', imageUrl: 'img/neust_logo.png' },
            { title: 'The Rise of Robotics', author: 'Isabella White', year: '2023', description: 'Exploring the impact of robotics in modern society.', imageUrl: 'img/neust_logo.png' },
            { title: 'Data Privacy in the Digital Age', author: 'Jack Thompson', year: '2024', description: 'The importance of data privacy in today\'s world.', imageUrl: 'img/neust_logo.png' },
            { title: 'Augmented Reality in Education', author: 'Kate Brown', year: '2023', description: 'Enhancing learning through augmented reality.', imageUrl: 'img/neust_logo.png' },
            { title: 'Artificial Intelligence in Healthcare', author: 'Liam Smith', year: '2024', description: 'How AI is transforming healthcare practices.', imageUrl: 'img/neust_logo.png' }
        ];

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

        function suggestResearchPapers(query, desiredCount) {
            // Filter research papers based on the search query
            const suggestions = researchPapers.filter(paper =>
                paper.title.toLowerCase().includes(query.toLowerCase()) ||
                paper.author.toLowerCase().includes(query.toLowerCase())
            );

            // If the number of suggestions is less than desiredCount, get the remaining random papers
            if (suggestions.length < desiredCount) {
                const remainingPapers = researchPapers.filter(paper => 
                    !suggestions.includes(paper)
                );

                // Shuffle remaining papers
                const shuffledRemaining = remainingPapers.sort(() => 0.5 - Math.random());
                const additionalCount = desiredCount - suggestions.length;

                // Combine suggestions with additional random papers
                suggestions.push(...shuffledRemaining.slice(0, additionalCount));
            }

            return suggestions;
        }

        // Example usage of the function
        const searchQuery = 'Machine'; // Change this to test different queries
        const desiredCount = 10; // Number of papers you want to display
        const suggestedPapers = suggestResearchPapers(searchQuery, desiredCount);

        if (suggestedPapers.length > 0) {
            suggestedPapers.forEach(paper => {
                addResearchCard(paper.title, paper.author, paper.year, paper.description, paper.imageUrl);
            });
        } else {
            const container = document.getElementById('research-container');
            container.innerHTML = '<p>No research papers found for your query.</p>';
        }
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
<script>
// function addResearchCard(title, author, year, description, imageUrl) {
//     const container = document.getElementById('research-container');
//     const card = document.createElement('div');
//     card.className = 'research-card';
//     card.innerHTML = `
//         <img src="${imageUrl}" alt="Research Image" class="research-image">
//         <h2 class="research-title">${title}</h2>
//         <p class="research-author">Author: ${author}</p>
//         <p class="research-year">Year: ${year}</p>
//         <p class="research-description">${description}</p>
//         <a href="#" class="read-more">Read More</a>
//     `;
//     container.appendChild(card);
// }

// function suggestResearchPapers(researchPapers, query, desiredCount) {
//     // Filter research papers based on the search query
//     const suggestions = researchPapers.filter(paper =>
//         paper.Title.toLowerCase().includes(query.toLowerCase()) ||
//         paper.Author.toLowerCase().includes(query.toLowerCase())
//     );

//     // If there are fewer suggestions than desired, get random papers to fill the gap
//     if (suggestions.length < desiredCount) {
//         const remainingCount = desiredCount - suggestions.length;
//         const randomPapers = researchPapers
//             .filter(paper => !suggestions.includes(paper)) // Exclude already suggested papers
//             .sort(() => Math.random() - 0.5) // Shuffle remaining papers
//             .slice(0, remainingCount); // Take only the required number
//         suggestions.push(...randomPapers);
//     }

//     return suggestions.slice(0, desiredCount); // Return the desired number of suggestions
// }

// function fetchResearchSuggestions() {
//     fetch('backend/Suggestresearch.php')
//         .then(response => response.json())
//         .then(researchPapers => {
//             const searchQuery = 'dynamic'; // You can change this to test different queries
//             const desiredCount = 10; // Set the desired count of suggestions

//             const suggestedPapers = suggestResearchPapers(researchPapers, searchQuery, desiredCount);

//             // Clear existing content before adding new cards
//             const container = document.getElementById('research-container');
//             container.innerHTML = '';

//             // Add each suggested paper to the DOM
//             suggestedPapers.forEach(paper => {
//                 addResearchCard(paper.Title, paper.Author, paper.Year, paper.Description, paper.ImageName);
//             });

//             // Handle case if no papers are found
//             if (suggestedPapers.length === 0) {
//                 container.innerHTML = '<p>No research papers found for your query.</p>';
//             }
//         })
//         .catch(error => console.error('Error fetching research papers:', error));
// }

// // Call the function to fetch research suggestions on page load
// fetchResearchSuggestions();
</script>
