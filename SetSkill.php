<?php
require_once 'verifier.php';

    if(!VerifyResearcher()){
        header("Location: homepage.php");
        exit;
}
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


<body>
<?php   include 'modal/header.php'; 
        include 'modal/ResearcherSidebar.php';
        $ResearchID = $_COOKIE["ResearchNya"];
        
        $conn = new mysqli("localhost", "mine", "pass", "repository");
        if ($conn->connect_error) {
            echo "error";
        }
        // SQL query to fetch data
        $sql = "SELECT * FROM `ResearchTBL` WHERE `ResearchID` = '$ResearchID';";
        $result = $conn->query($sql);
       
         if ($result) {
            $ResearchInfo = $result->fetch_assoc();
            echo $ResearchInfo['CourseID'];
        
        

?>
<div class="content">
<div class="relative">  

    <form>
        <h2>Research info</h2>
        <h5><b>RESEARCH TITLE </b></h5>
        <div class="input-group centerer" style="padding-left:15%; padding-right:15%; ">
        <?php echo  '<input class="border border-primary text-center" type="text" id="Title" name="Title" value= "'. $ResearchInfo['Title'] . '" disabled="disabled"> '?>
        </div>
        <BR></BR>
        <h5><b>RESEARCH ABSTRACT</b></h5>

        <div class="mb-3 centerer"style="padding-left:15%; padding-right:15%;">
        <?php echo  '<textarea class="form-control border border-primary"   id="exampleFormControlTextarea1" disabled="disabled" rows="3"> '.$ResearchInfo['Abstract'].' </textarea>'?>
        </div>
        
    </form>
    <br><br>
    <form action="SetSkillapi.php" method="POST">
    <div class="d-flex justify-content-center">
        <div id="input-container">
            SET YOUR SKILLS
            <div class="input-group px-2 ">
                <input type="text" name="inputField[]" placeholder="Enter something">
                <button type="button" class="add-input">+</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        <?php } ?>
</form>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputContainer = document.getElementById('input-container');
            const addButton = document.querySelector('.add-input');
            let inputCount = 1;

            addButton.addEventListener('click', function() {
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
                    });
                });
            });
        });
    </script>
</div>
</body>
</html>
