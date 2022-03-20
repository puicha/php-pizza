<?php
    // Call db_connect.php to connect to database
    include 'config/db_connect.php';

    // Write query to select all all pizzas
    $sql = "SELECT title, ingredients, id  FROM pizza";

    // Make query & get result, assign result to $result variable
    $result = mysqli_query($conn, $sql);

    // Fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free the result from the memory
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
    <!--Include header for webpage-->
    <?php include 'templates/header.php';  ?>  
    <h4 class="center grey-text">Welcome to Morse Pizza</h4>
    <div class="container">
        <div class="row">
            <!--Display data from the database using foreach loop to loop through data -->
            <?php foreach($pizzas as $pizza): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <!--Call pizza image-->
                        <img src="img/pizza.png" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <!--Use explode and foreach to make a list of ingredients -->
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="details.php?id=<?php echo $pizza['id']; ?>">more info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--Include footer for webpage-->
    <?php include 'templates/footer.php';  ?>
</html>