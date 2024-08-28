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
header {
    background-color: #1e3698;
    color: #fff;
    padding: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 10%;
    margin-bottom:10px;
    padding-bottom: 5px;
    border-bottom: 4px solid  rgb(24, 228, 255);
    z-index: 3;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav ul li {
    margin-top:-10px;
    margin-left: 20px;
}

nav ul li:first-child {
    margin-left: 0;
}
img{
    width: 100% ;
}
nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
}
.image{
    margin-left: 1rem;
    width: 5% ;
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


/* Media query for small screens (mobile devices) */
@media screen and (max-width: 600px) {
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
    img{
    width: 100% ;
    }
    .image{
        margin-left: 1rem;
    width: 9% ;
    }
    nav ul {
        display: none; /* Hide the navigation links by default on small screens */
    }
    /* Style the burger menu icon to make it look like a button */
    .burger-menu {
        display: block; /* Display the burger menu icon */
        cursor: pointer; /* Change cursor to pointer to indicate clickability */
        font-size: 30px; /* Increase font size for better visibility */
        padding: 5px; /* Add padding for better touch interaction */
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
}




    </style>
</head>
<body>

<header><a href="homepage.php" class="image">
    <img src="img/neust_logo.png"  alt="Neust Logo"></a>
    <h3>NEUST Repository</h3>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="./about.php">About</a></li>
            <li><a href="./TeacherS.php">Teachers</a></li>
            <li><a href="./TeacherS.php"><span class="line-md--download-outline"></span></a></li>
            <li><a href="./logout.php"><span class="material-symbols--logout-sharp"></span></a></li>
        </ul>
    </nav>
   
    <div class="burger-menu" onclick="toggleMenu()"><span class="game-icons--hamburger-menu"></span></div>
    
    <?php $cookie_value = $_COOKIE["RepSesID"];
        $lastChar = substr($cookie_value, -1);

        if ($lastChar === '1') {
            echo "<a href='./Accounts.php' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
        } else if ($lastChar === '9') {
            echo "<a href='./CapTSection.php' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
        }else if ($lastChar === '8') {
            echo "<a href='./UploadResearchInfo.php' class='profile'> <span class='iconamoon--profile-circle-fill'></span></a>";
        }
 ?>
    
</header>

<script>
    // JavaScript function to toggle the display of the navigation links
    function toggleMenu() {
        document.querySelector('nav ul').classList.toggle('show');
    }
</script>

</body>
</html>
