
<?php require_once("db.php"); ?>



<form name="search" method="post">
    <input type="text" id="search" name="search"/>
    <button type="submit" value="search"
</form>

<div class="container-fluid mt-5">
    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["search"])) {
            $sql = "SELECT title, author, price, image FROM books";
        }
        else {
            $key = $_POST["search"];
            $sql = "SELECT title, author, price, image FROM books WHERE title = '$key' OR Author = '$key'";
        }
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "Title: " . $row["title"]. " - Author: " . $row["author"]. " " . " - Price " . $row["price"]."<br>";
            }
          } else {
            echo "0 results";
          }
    }

    ?>
    <nav aria-label="Page navigation example">
    <ul class="pagination mt-5">
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
        </a>
        </li>
    </ul>
    </nav>
</div>