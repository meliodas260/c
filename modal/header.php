<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Name</title>

    <style>
        .dropdown-container {
            padding-right:2em;
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 160px;
            top: 100%;
            transform: translateX(-70%);
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        .dropdown-container:hover .dropdown-menu {
            display: block;
        }
header {
    background-color: #1e3698;
    color: #fff;
    padding: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 7%;
    margin-bottom:-1px;
    padding-bottom: 0px;
    border-bottom: 1px solid  rgb(24, 228, 255);
    z-index: 3;
}
nav {
    flex: 1;
}
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align:right;
    float:right;
    display: flex;
    justify-content: flex-end;
}

nav ul li {
    
    margin-top: 10px;
    margin-left: 20px;
}

nav ul li:first-child {
    margin-left: 0;
}
.image {
            margin-left: 1rem;
            width: auto;
            height: 50px;
        }

        img {
            height: 100%;
            width: auto;
        }

nav ul li a {
   
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
}
.iconamoon--profile-circle-fill {
  display: inline-block;
  width: 3em;
  height: 3em;
  color :white;
  --svg: url("img/avatar-default-icon-1024x1024-dvpl2mz1.png");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}
.profile{
    margin-right: 1rem;
}
.material-symbols-light--logout-sharp {
  display: inline-block;
 
  width: 1.2em;
  height: 1.2em;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M4 20V4h8.02v1H5v14h7.02v1zm12.462-4.461l-.702-.72l2.319-2.319H9.192v-1h8.887l-2.32-2.32l.702-.718L20 12z'/%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}
  .iconamoon--profile-thin {
        display: inline-block;
        width: 1.7em;
        height: 1.7em;
        --svg: url("img/avatar-default-icon-1024x1024-dvpl2mz1.png");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
        }
    .headH4{
        margin-left:1em;
    }
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
        .center-div {
            display: flex;
            justify-content: center; /* Horizontal centering */
            align-items: center;
            padding:auto;
            margin:auto;
}
.rounder{
    
    border-radius:20px;
}
.carbon--search-advanced {
    display: inline-block;
    width: 1em;
    height: 1em;
    --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath fill='%23000' d='M30 6h-4V2h-2v4h-4v2h4v4h2V8h4zm-6 22.586l-5.975-5.975a9.023 9.023 0 1 0-1.414 1.414L22.586 30zM4 17a7 7 0 1 1 7 7a7.008 7.008 0 0 1-7-7'/%3E%3C/svg%3E");
    background-color: white;
    -webkit-mask-image: var(--svg);
    mask-image: var(--svg);
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-size: 100% 100%;
    mask-size: 100% 100%;
  }
/* Media query for small screens (mobile devices) */
@media screen and (max-width: 1000px) {
    .image{
        text-align:center;
        justify-self: center;
    }
    .endder{
        margin: 0;
    padding: 0;
    text-align:right;
    float:right;
    display: flex;
    justify-content: flex-end;
    }
    .iconamoon--profile-circle-fill {
    display: inline-block;
    width: 2em;
    height: 2em;
    color :white;
    margin-top:9px;
    --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' fill-rule='evenodd' d='M12 4a8 8 0 0 0-6.96 11.947A4.99 4.99 0 0 1 9 14h6a4.99 4.99 0 0 1 3.96 1.947A8 8 0 0 0 12 4m7.943 14.076A9.959 9.959 0 0 0 22 12c0-5.523-4.477-10-10-10S2 6.477 2 12a9.958 9.958 0 0 0 2.057 6.076l-.005.018l.355.413A9.98 9.98 0 0 0 12 22a9.947 9.947 0 0 0 5.675-1.765a10.055 10.055 0 0 0 1.918-1.728l.355-.413zM12 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6' clip-rule='evenodd'/%3E%3C/svg%3E");
    background-color: currentColor;
    -webkit-mask-image: var(--svg);
    mask-image: var(--svg);
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-size: 100% 100%;
    mask-size: 100% 100%;
    }
    nav ul {
        display: none; /* Hide the navigation links by default on small screens */
    }
    /* Style the burger menu icon to make it look like a button */
    .burger-menu {
        display: block;
        cursor: pointer;
        font-size: 30px;
        padding: 5px;
    }
    .game-icons--hamburger-menu {
    margin-top:-10px;
     display: inline-block;
     width: 0.6em;
     height: 0.6em;
     --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23000' d='M32 96v64h448V96zm0 128v64h448v-64zm0 128v64h448v-64z'/%3E%3C/svg%3E");
     background-color: currentColor;
     -webkit-mask-image: var(--svg);
     mask-image: var(--svg);
    -webkit-mask-repeat: no-repeat;
     mask-repeat: no-repeat;
     -webkit-mask-size: 100% 100%;
     mask-size: 100% 100%;
    }
    
    .burger-menu::before {
        content: ""; /* Unicode for burger icon */
    }

    /* Show navigation links when the burger menu is clicked */
    nav ul.show {
        text-align:center;
        display: flex; /* Show navigation links */
        flex-direction: column; /* Stack navigation links vertically */
        position: absolute; /* Position the menu */
        top: 65px; /* Adjust the top position */
        left: 0; /* Align with the left edge */
        background-color: rgba(21, 47, 87, 0.9); /* Background color for the menu */
        width: 100%; /* Full width */
        padding: 10px; /* Add padding */
        z-index: 4; /* Lowest layer */

    }

    nav ul.show li {
        margin: 10px 0; /* Add spacing between menu items */
    }
    .iconamoon--profile-thin {
        display: inline-block;
        width: 2.8em;
        height: 2.8em;
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' stroke='%23000'%3E%3Cpath stroke-linejoin='round' d='M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z'/%3E%3Ccircle cx='12' cy='7' r='3'/%3E%3C/g%3E%3C/svg%3E");
        background-color: currentColor;
        -webkit-mask-image: var(--svg);
        mask-image: var(--svg);
        -webkit-mask-repeat: no-repeat;
        mask-repeat: no-repeat;
        -webkit-mask-size: 100% 100%;
        mask-size: 100% 100%;
        }
    
.removeSearch{
        display: none;
    }
}
    </style>
</head>
<body>

<header><div class="burger-menu" onclick="toggleMenu()"><span class="game-icons--hamburger-menu"></span></div>
<div class="center-div">
    <a href="homepage.php" class="image">
    <img src="img/neust_logo.png"  alt="Neust Logo"></a>
    <div class="headH4">
        <h4>RESEARCH REPOSITORY</h4>
    </div>
</div>
    <div class="input-group mb-3 endder" >
        <button class="btn btn-outline-secondary rounded" style="margin:1rem 0% 0 90%; @media screen and (max-width: 600px) {padding:1rem 2% 0 5%;} " type="button" id="openModalBtn"><span class="carbon--search-advanced"></span></button>        
    </div>
       
   <!-- modal -->
    <div id="advancedSearchModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Advanced Search</h2>
                <form id="searchForm">
                    <div class="form-group">
                        <input type="text" class="form-control" id="Title" name="Title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="Tag">Tag:</label>
                        <input type="text" class="form-control" id="Tag" name="Tag">
                    </div>
                    <div class="form-group">
                        <label for="Course">Course:</label>
                        <input type="text" class="form-control" id="Course" name="Course">
                    </div>
                    <div class="form-group">
                        <label for="Keyword">Keyword:</label>
                        <input type="text" class="form-control" id="Keyword" name="Keyword">
                    </div>

                    <button type="submit" class="modalbutton">Search</button>
                    <button type="button" id="clearBtn" class="modalbutton">Clear</button>
                </form>
            </div>
    </div>
    <script>
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Gather form data
    const title = document.getElementById('Title').value;
    const tag = document.getElementById('Tag').value;
    const course = document.getElementById('Course').value;
    const keyword = document.getElementById('Keyword').value;

    // Create URL with query parameters
    const queryParams = new URLSearchParams();
    if (title) queryParams.append('Title', title);
    if (tag) queryParams.append('Tag', tag);
    if (course) queryParams.append('Course', course);
    if (keyword) queryParams.append('Keyword', keyword);

    // Redirect to the constructed URL
    window.location.href = `searchy?${queryParams.toString()}`;
});

// Clear button functionality
document.getElementById('clearBtn').addEventListener('click', function() {
    document.getElementById('Title').value = '';
    document.getElementById('Tag').value = '';
    document.getElementById('Course').value = '';
    document.getElementById('Keyword').value = '';
});
</script>
    <nav>
        <ul>
            <li><a href="homepage">Home</a></li>
            <li><a href="./about">About</a></li>
            <li><a href="./TeacherS">Teachers</a></li>
            <li><a href="./TeacherS"><span class="f7--square-favorites-alt-fill"></span></a></li>
            <li><div class="dropdown-container">
                    <a href="./profile" class="rounder"><span class="iconamoon--profile-thin"></span></a>
                    <div class="dropdown-menu">
                    <?php 
    $cookie_value = $_COOKIE["RepSesID"];
        $lastChar = substr($cookie_value, -1);

        if ($lastChar === '1') {
            echo "<a href='./Accounts'> <span> Admin</span></a>";
        } else if ($lastChar === '9') {
            echo "<a href='./CapTSection'> <span> Capstone</span></a>";
        }else if ($lastChar === '8') {
            echo "<a href='./UploadResearchInfo'> <span>Student</span></a>";
        }
 ?>
                        <a href="#">Action 2</a>
                        <a href="logout.php"><span class="material-symbols-light--logout-sharp"></span><span>Logout</span></a>
                    </div>
                </div>
            
            </li>
        </ul>
    </nav>
   


    
</header>

<script>
    // JavaScript function to toggle the display of the navigation links
    function toggleMenu() {
        document.querySelector('nav ul').classList.toggle('show');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="modal/modal.js"></script>

</body>
</html>
