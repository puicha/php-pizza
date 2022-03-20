<?php
 // Sample of how to use session
 session_start();

 // Use null coalescing to display 'Guest' if $_SESSION is not set otherwise display that $_SESSION name
 // the session "name" is created in sandbox.php
 $name = $_SESSION['name'] ?? 'Guest';
 
 // Set session time out
 $_SESSION['time_out'] = time() + 120;  
 
 if (isset($_SESSION['time_out']) && time() > $_SESSION['time_out']){
    session_unset();
    session_destroy();
 }

?>

<head>
    <title>Morse Pizza</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Create custom css-->
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }

        .brand-text{
            color: #cbb09c !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        .pizza{
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -15px;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Morse Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li>
                <li><a href ="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>

