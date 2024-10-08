<?php
// require_once 'verifier.php';

//     if(!VerifyResearcher()){
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
    <title>Research info page</title>
</head>

<style>
        .info {
            display: none;
            margin-top: 10px;
        }
        .mingcute--information-fill {
    display: inline-block;
    width: 1.5em;
    height: 1.5em;
    --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none'%3E%3Cpath d='M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z'/%3E%3Cpath fill='%23000' d='M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m-.01 8H11a1 1 0 0 0-.117 1.993L11 12v4.99c0 .52.394.95.9 1.004l.11.006h.49a1 1 0 0 0 .596-1.803L13 16.134V11.01c0-.52-.394-.95-.9-1.004zM12 7a1 1 0 1 0 0 2a1 1 0 0 0 0-2'/%3E%3C/g%3E%3C/svg%3E");
    background-color: currentColor;
    -webkit-mask-image: var(--svg);
    mask-image: var(--svg);
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-size: 100% 100%;
    mask-size: 100% 100%;
  }
    </style>    
<body>
    
 
<?php   include 'modal/header.php'; 
        include 'modal/ResearcherSidebar.php';
        // $ResearchID = $_COOKIE["ResearchNya"];
        
        // $pdo = new mysqli("localhost", "mine", "pass", "repo");
        // if ($pdo->connect_error) {
        //     echo "error";
        // }
        // // SQL query to fetch data
        // $sql = "SELECT * FROM `ResearchTBL` WHERE `ResearchID` = '$ResearchID';";
        // $result = $pdo->query($sql);
       
        //  if ($result) {
        //     $ResearchInfo = $result->fetchAll(PDO::FETCH_ASSOC);
        //     echo $ResearchInfo['CourseID'];
        
        

?>

<div class="content">
    <div class="position-relative">
        <div class="position-absolute top-0 end-0">
            <button onclick="toggleInfo()" class="btn rounded-pill border-0 "> <h3><span class="mingcute--information-fill"></span></h3></button>
        </div>
    </div>
    
    <div id="researchInfo" class="info">
        <h3>Research Tags</h3>
        <p>Research tags are like labels that summarize what a research paper is about. They help organize and find similar studies.</p>
        <h3>Research Keywords</h3>
        <p>Research keywords are specific words or phrases that capture the main idea of a study. They're like shortcuts for finding relevant articles.</p>
        <p>Both research tags and keywords help researchers find and understand papers more easily.</p>
    </div>

    <form  action="researchinfoapi.php" method="POST">
        <div class="relative"> 
        <?php 
            echo $ResearchID; 
        ?>
            <h2>Research info</h2>
            <h5><b>RESEARCH TITLE </b></h5>
            <div class="input-group centerer" style="padding-left:15%; padding-right:15%; ">
               <?php echo  '<input class="border border-primary text-center" type="text" id="Title" name="Title" value= "'. $ResearchInfo['Title'] . '" required> '?>
            </div>
            <BR></BR>
            <h5><b>RESEARCH ABSTRACT</b></h5>

            <div class="mb-3 centerer"style="padding-left:15%; padding-right:15%;">
            <?php echo  '<textarea class="form-control border border-primary"   id="exampleFormControlTextarea1" name="Abstract" rows="3"> '.$ResearchInfo['Abstract'].' </textarea>'?>
            </div>
            <h2>Research Info</h2>
                <div class="d-flex justify-content-center text-center">
                <?php 
                echo '<div class="w-50 px-2"> <h4>Keywords used</h4>';
                $sql = "SELECT * FROM `ReasearchKeyWordsTBL` WHERE `ReasearchID` ='$ResearchID';";
                $result = $pdo->query($sql);
            
                if ($result) { 
                    while ($ResearchInfo = $result->fetch_assoc()){
                    echo $ResearchInfo['Keywords'] . "<br>" ;
                }
                }
                echo "</div>";

                echo '<div class="w-50 px-2">
                <h4>Tags used</h4>';
                $sql = "SELECT * FROM `ReasearchTagTBL` WHERE `ReasearchID` ='$ResearchID'";
                $result = $pdo->query($sql);
               
                if ($result) { 
                    while ($ResearchInfo = $result->fetch_assoc()){
                    echo $ResearchInfo['TagName'] . "<br>" ;
                }
                }
                $keywordCount = $result->num_rows; // Count the number of keywords
                
                // Inject keyword count into JavaScript
                echo "<script>const initialKeywordCount = $keywordCount;</script>";
                
                echo "</div>";
                ?>
                </div>
            <div class="d-flex justify-content-center text-center">
                <div id="input-container">
                    Keywords
                    <div class="input-group px-2 ">
                        <input type="text" name="inputField[]" placeholder="Enter something">
                        <button type="button" class="add-input">+</button>
                    </div>
                </div>
                <div id="input-container2">
                    Tags
                    <div class="input-group px-2 ">
                        <input type="text" name="tags[]" placeholder="Enter something">
                        <button type="button" class="add-tags">+</button>
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        <?php //}?>
    </form>
      </div>
      








      <script>
      function toggleInfo() {
            var infoDiv = document.getElementById("researchInfo");
            if (infoDiv.style.display === "none") {
                infoDiv.style.display = "block";
            } else {
                infoDiv.style.display = "none";
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
    const inputContainer = document.getElementById('input-container');
    const addButton = document.querySelector('.add-input');
    let inputCount = 1;
    
    addButton.addEventListener('click', function() {
        if (inputCount < 5) { // Check if inputCount is less than 5
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group');
            newInputGroup.innerHTML = `
                <input type="text" name="inputField[${inputCount}]" placeholder="Enter something">
                <button type="button" class="remove-input">-</button>
            `;
            inputContainer.appendChild(newInputGroup);
            inputCount++;

            const removeButtons = document.querySelectorAll('.remove-input');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    newInputGroup.remove();
                    inputCount--; // Decrement inputCount when removing an input field
                });
            });
        } else {
            alert("You can't add more than 5 Keywords.");
        }
    });
});

        document.addEventListener('DOMContentLoaded', function() {
            const inputContainer2 = document.getElementById('input-container2');
            const addButton = document.querySelector('.add-tags');
            let inputCount = 1;

            addButton.addEventListener('click', function() {
                if (inputCount < 5) {
                const newInputtag = document.createElement('div');
                newInputtag.classList.add('input-group');
                newInputtag.innerHTML = `
                    <input type="text" name="tags[${inputCount}]" placeholder="Enter something">
                    <button type="button" class="remove-tags">-</button>
                `;
                inputContainer2.appendChild(newInputtag);
                inputCount++;

                const removeButtons = document.querySelectorAll('.remove-tags');
                removeButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        newInputtag.remove();
                    });
                });
            } else {
            alert("You can't add more than 5 tags.");
        }
            });
        });
    </script>

</body>
</html>
