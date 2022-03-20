<?php
    // Call db_connect.php to connect to database
    include 'config/db_connect.php';

    // Check GET request id param and retrieve the single record based on that ID from database
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // Write query 
        $sql = "SELECT * FROM pizza WHERE id = $id";

        // Make query & get result
        $result = mysqli_query($conn, $sql);

        // Fetch the resulting rows as an array
        $pizza = mysqli_fetch_assoc($result);

        // Free the result from the memory
        mysqli_free_result($result);

        // Close connection
        mysqli_close($conn);
    }

    // If delete button is clicked ,delete that data from the database (use id to refer to that data in database)
    if(isset($_POST["delete"])){

        // Validate data
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        
        // Create query
        $sql = "DELETE FROM pizza WHERE id = $id_to_delete";

        // Run query, use if-else to handle error
        if(mysqli_query($conn, $sql)){
            // Redirect to homepage
            header('Location: index.php');
        } else {
            echo "query error: " . mysqli_error($conn);
        }      
    }
?>
<!DOCTYPE html>
<html>
<?php include 'templates/header.php';  ?>

<div class="container center grey-text">
    <?php if($pizza): ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
        
        <!--DELETE FORM -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Use hidden type input because it does not need to be displayed on the form -->
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <!-- Add DELETE button -->
            <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
        </form>

    <?php else: ?>    
        <h5>No such pizza exist!</h5>
    <?php endif; ?>
</div>

<?php include 'templates/footer.php';  ?>
</html>
