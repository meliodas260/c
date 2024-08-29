<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Name</title>

    <style>
        /* Additional styles specific to the header can also be included here */
        /* For example, styles for the header background color, text color, etc. */
        /* For simplicity, I'll add some basic styles here */
       
/* Additional styles specific to the header can also be included here */
/* For example, styles for the header background color, text color, etc. */
/* For simplicity, I'll add some basic styles here */
        .dropdown-container {
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
    margin-bottom:10px;
    padding-bottom: 5px;
    border-bottom: 4px solid  rgb(24, 228, 255);
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
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' fill-rule='evenodd' d='M12 4a8 8 0 0 0-6.96 11.947A4.99 4.99 0 0 1 9 14h6a4.99 4.99 0 0 1 3.96 1.947A8 8 0 0 0 12 4m7.943 14.076A9.959 9.959 0 0 0 22 12c0-5.523-4.477-10-10-10S2 6.477 2 12a9.958 9.958 0 0 0 2.057 6.076l-.005.018l.355.413A9.98 9.98 0 0 0 12 22a9.947 9.947 0 0 0 5.675-1.765a10.055 10.055 0 0 0 1.918-1.728l.355-.413zM12 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6' clip-rule='evenodd'/%3E%3C/svg%3E");
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
.line-md--download-outline {
  display: inline-block;
  width: 1.8rem;
  height: 1.8rem;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' stroke='%23000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'%3E%3Cpath stroke-dasharray='14' stroke-dashoffset='14' d='M6 19h12'%3E%3Canimate fill='freeze' attributeName='stroke-dashoffset' begin='0.5s' dur='0.4s' values='14;0'/%3E%3C/path%3E%3Cpath stroke-dasharray='18' stroke-dashoffset='18' d='M12 4 h2 v6 h2.5 L12 14.5M12 4 h-2 v6 h-2.5 L12 14.5'%3E%3Canimate fill='freeze' attributeName='stroke-dashoffset' dur='0.4s' values='18;0'/%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}  
.material-symbols--logout-sharp {
    display: inline-block;
    width: 1.7em;
    height: 1.7em;
    color :white;
    --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M3 21V3h9v2H5v14h7v2zm13-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z'/%3E%3C/svg%3E");
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
        --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' stroke='%23000'%3E%3Cpath stroke-linejoin='round' d='M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z'/%3E%3Ccircle cx='12' cy='7' r='3'/%3E%3C/g%3E%3C/svg%3E");
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
        display: flex; /* Show navigation links */
        flex-direction: column; /* Stack navigation links vertically */
        position: absolute; /* Position the menu */
        top: 65px; /* Adjust the top position */
        left: 0; /* Align with the left edge */
        background-color: rgb(21, 47, 87); /* Background color for the menu */
        width: 100%; /* Full width */
        padding: 10px; /* Add padding */
        z-index: 4; /* Lowest layer */

    }

    nav ul.show li {
        margin: 10px 0; /* Add spacing between menu items */
    }
    .iconamoon--profile-thin {
        display: inline-block;
        width: 1em;
        height: 1em;
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
        <h4>RESEARCH REPOSYTORY</h4>
    </div>
</div>
    <div class="input-group mb-3 endder" style="margin:1rem 15% 0 15%; @media screen and (max-width: 600px) {padding:1rem 5% 0 5%;} ">
        <input type="text" class="form-control removeSearch" placeholder="Search" aria-label="Search" name="normalSearch">
        <button class="btn btn-outline-secondary removeSearch rounded" type="button"  ><span class="mdi--search"></span></button>
        <button class="btn btn-outline-secondary rounded" type="button" id="openModalBtn"><span class="carbon--search-advanced"></span></button>        
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
    <nav>
        <ul>
            <li><a href="homepage">Home</a></li>
            <li><a href="./about">About</a></li>
            <li><a href="./TeacherS">Teachers</a></li>
            <li><a href="./TeacherS"><span class="line-md--download-outline"></span></a></li>
            <li><div class="dropdown-container">
                    <a href="./profile" class="btn btn-primary"><span class="iconamoon--profile-thin"></span></a>
                    <div class="dropdown-menu">
                        <a href="#">Action 1</a>
                        <a href="#">Action 2</a>
                        <a href="#">Action 3</a>
                    </div>
                </div>
            
            </li>
        </ul>
    </nav>
   
    
    
    <?php 
    // $cookie_value = $_COOKIE["RepSesID"];
    //     $lastChar = substr($cookie_value, -1);

    //     if ($lastChar === '1') {
    //         echo "<a href='./Accounts' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
    //     } else if ($lastChar === '9') {
    //         echo "<a href='./CapTSection' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
    //     }else if ($lastChar === '8') {
    //         echo "<a href='./UploadResearchInfo' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
    //     }
 ?>
    
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
