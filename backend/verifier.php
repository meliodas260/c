<?php
function Verifyadmin(){
// Check if the cookie is set
if(isset($_COOKIE["RepSesID"])) {
    // Retrieve the cookie value
    $cookie_value = $_COOKIE["RepSesID"];

    $lastChar = substr($cookie_value, -1);

    if ($lastChar === '1') {
        return true;
    } else {
    header("Location: homepage.php");
            exit;
    }
} else {
    header("Location: index.php");
    exit;
}}
function VerifyCApT(){
    // Check if the cookie is set
    if(isset($_COOKIE["RepSesID"])) {
        // Retrieve the cookie value
        $cookie_value = $_COOKIE["RepSesID"];
    
        $lastChar = substr($cookie_value, -1);
    
        if ($lastChar === '9') {
            return true;
        } else {
        header("Location: homepage.php");
                exit;
        }
    } else {
        header("Location: index.php");
        exit;
    }}
    function VerifyResearcher(){
        // Check if the cookie is set
        if(isset($_COOKIE["RepSesID"])) {
            // Retrieve the cookie value
            $cookie_value = $_COOKIE["RepSesID"];
        
            $lastChar = substr($cookie_value, -1);
        
            if ($lastChar === '8') {
                return true;
            }elseif ($lastChar === '7') {
                return true;
            } else {
            header("Location: homepage.php");
                    exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }}
        function Verifyuser(){
            // Check if the cookie is set
            if(isset($_COOKIE["RepSesID"])) {
                // Retrieve the cookie value
                $cookie_value = $_COOKIE["RepSesID"];
            
                $lastChar = substr($cookie_value, -1);
            
                if ($lastChar === '0' &&  $lastChar === '7' &&  $lastChar === '8'&&  $lastChar === '9')  {
                    return true;
                } else {
                header("Location: homepage.php");
                        exit;
                }
            } else {
                header("Location: index.php");
                exit;
            }}
?>
