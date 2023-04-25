
<?php require_once("db.php"); ?>



<form name="search" method="post">
    <input type="text" id="search" name="search"/>
    <button type="submit" value="search"
</form>

<div class="container-fluid mt-5">
    <?php 
        $number= 1;
        $numbers = array(1,2,3);
        $result_per_page = 10;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["search"])) {
            $sql = "SELECT title, author, price, image FROM books";
        }
        else {
            $key = $_POST["search"];
            $sql = "SELECT title, author, price, image FROM books WHERE title = '$key' OR Author = '$key'";
        }

        $result = $conn->query($sql);
        $number_of_result = mysqli_num_rows($result);
        $number_of_page = ceil ($number_of_result / $result_per_page);  
        
        $sql = $sql.' LIMIT ' . $result_per_page;
        // echo $sql;
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_array($result)) {  
            echo $row['title'] . ' -By.  ' . $row['author'] . ' -Price: ' . $row['price'] . '</br>';  
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