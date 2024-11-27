<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: transparent;
        }
        .sidebar-button {
            display: block; /* Ensures it spans full width */
            padding: 10px 15px; /* Adds spacing */
            margin: 5px 0; /* Adds spacing between buttons */
            text-decoration: none; /* Removes underline */
            background-color: #adb7dd; /* Sidebar button background color */
            color: white; /* Text color */
            border-radius: 5px; /* Rounded corners */
            text-align: center; /* Center-align the text */
            font-weight: bold; /* Makes the text bold */
            transition: background-color 0.3s, transform 0.2s; /* Smooth hover effects */
        }

        .sidebar-button:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: scale(1.05); /* Slightly enlarges the button */
            color: white; /* Ensures text remains visible */
        }

        .sidebar-button h5 {
            margin: 0; /* Removes extra margin around <h5> */
            font-size: 1.1rem; /* Adjusts font size */
        }
        .light {
    color: white; /* Text color */
    font-family: 'Arial', sans-serif; /* Clean, modern font */
    font-weight: bold; /* Makes the text bold */
    font-size: 1.3rem; /* Adjusts the font size */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Subtle shadow for better readability */
    letter-spacing: 0.5px; /* Adds slight spacing between letters */
    line-height: 1.5; /* Improves readability by increasing line spacing */
}


    </style>
</head>

        <!-- Sidebar -->
        <div id="sidebar" class="">
            
            <ul class="nav flex-column">
                <?php 
                    $cookie_value = $_COOKIE["RepSesID"];
                        $lastChar = substr($cookie_value, -1);

                        if ($lastChar === '1') {
                            ?>                
                             <h4 class="text-center py-3 light">ADMIN</h4>
                             <br>
                            <li>
                            <a class="sidebar-button" href="./Accounts"><h5>Accounts</h5></a>
                            </li>
                            <li>
                                <a class="sidebar-button" href="./setSection"><h5>Sections</h5></a>
                            </li>
                            <li>
                                <a class="sidebar-button" href="./SetBestResearch"><h5>Set Best Research</h5></a>
                            </li>
                            <li>
                                <a class="sidebar-button" href="Reports"><h5>Reports</h5></a>
                            </li>
                        <?php 
                        } else if ($lastChar === '9') {
                      
                           ?>
                           <h4 class="text-center py-3 light">Research Teacher</h4>
                           <br>
                                <li>
                                    <a href="CapTSection"  class="sidebar-button"><h5>Sections</h5></a>
                                </li>           
                           <?php 
                        }else if ($lastChar === '8') {
                        ?>    
                            <h4 class="text-center py-3 light">Researcher</h4>
                           <br>
                                <li>
                                    <a href="RateTeacher" class="sidebar-button"><h5>Rate Experts</h5></a>
                                </li>  
                        
                        <?php 
                        }
                ?>
                <h4 class="text-center py-3 light">USER</h4>
                <li>
                    <a href="profile" class="sidebar-button"><h5>Profile</h5></a>
                </li> 
                <li>
                    <a href="logout" class="sidebar-button"><h5>Logout</h5></a>
                </li> 

            </ul>
        </div>
        
<body>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
