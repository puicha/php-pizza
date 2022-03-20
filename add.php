<?php

    // Call db_connect.php to connect to database
    include 'config/db_connect.php';

    // Initlize variables
    $title = $email = $ingredients = "";

    // Create associative array to store error values which will be assigned dynamically
    $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
    
    // Validate user inputs
    // If submit button is clicked
    if(isset($_POST["submit"])){
        // If no email input
        if(empty($_POST["email"])){
            // Assign error message to 'email' array key
            $errors['email'] = "An email is required <br />";
        } else {
            // Has email input, assign value to $email variable
            $email  = $_POST['email'];
            // Use filter_var function to validate email input
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                // Assign error message to 'email' array key
                $errors['email'] = "Email must be a valid email address";
            }
        }
        // If no title input
        if(empty($_POST["title"])){
            // Assign error message to 'title' array key
            $errors['title'] = "A title is required <br />";
        } else {
            // Has title input, assign value to $title variable
            $title = $_POST['title'];
            // Use preg_match function and regex to validate input
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                // Assign error message to 'title' array key
                $errors['title'] = "Title must be letters and spaces only";
            }
        }
        // If no ingredients input
        if(empty($_POST["ingredients"])){
            // Assign error message to 'ingredients' array key
            $errors['ingredients'] = "At least one ingredients is required <br />";
        } else {
            // Has ingredients input, assign value to $ingredients variable
            $ingredients = $_POST['ingredients'];
            // Use preg_match function and regex to validate input
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                // assign error message to 'ingredients' array key
                $errors['ingredients'] = "Ingredients must be a comma seperated list";
            }
        }
        // When no error, after the user clicked submit button, add user input to the database and then 
        // redirect to home page (index.php) using header function
        if(!array_filter($errors)){

            // Validate user input before add to the database
            $email = mysqli_real_escape_string($conn, $email);
            $title = mysqli_real_escape_string($conn, $title);
            $ingredients = mysqli_real_escape_string($conn, $ingredients);
            
            // Create query to insert user input to database
            $sql = "INSERT INTO pizza(title,email,ingredients) VALUES ('$title', '$email', '$ingredients')";
            
            // Run the query
            if(mysqli_query($conn, $sql)){     
                // Redirect to homepage
                header('Location: index.php');
            } else {
                echo "query error: " . mysqli_error($conn);
            }           
        }
    }
     // Close connection
     mysqli_close($conn);       
?>
<!DOCTYPE html>
<html>
    <!--Include header for webpage-->
    <?php include 'templates/header.php';  ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <!--Create form to gather user input-->
        <form class="white" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" >
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" >
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>   
    <!--Include footer for the webpage-->
    <?php include 'templates/footer.php';  ?>
</html>
