<?php 
    include 'db.php';
    echo '<form>
        <label for="records">Limit records</label>
        <input type="text" id="records" name="records">
        <button type="submit">Send</button>
    </form>';
    $limit = isset($_GET["records"])? $_GET["records"] : 5;
    $pagenum = isset($_GET['pagenum'])? $_GET['pagenum'] : 1;

    $result = $conn->query("SELECT Title, Author, Price FROM books");
    $total_rows = $result->num_rows;
    $total_pages = ceil($total_rows/$limit);
    $start = ($pagenum - 1) * $limit;
    $pag_result = $conn->query("SELECT Title, Author, Price FROM books ORDER BY Title ASC LIMIT $start, $limit");

    $books = $pag_result->fetch_all(MYSQLI_ASSOC)

?>

<nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            echo '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
                for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item"><a class="page-link" href="store.php?pagenum='.$i.'">'.$i.'</a></li>';
                }
            echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
            ?>
        </ul>
    </nav>


<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($books as $book) : ?>
            <tr>
                <td><?= $book['Title']; ?></td>
                <td><?= $book['Author']; ?></td>
                <td><?= $book['Price']; ?></td>
            <tr>
        <?php endforeach;?> 
    </tbody>
</table>