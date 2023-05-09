<?php 
    include 'db.php';
    echo '<form method="POST" action="index.php?page=store">
        <label for="records">Limit records</label>
        <input type="text" id="records" name="records">
        <button type="submit">Send</button>
    </form>';
    $limit = isset($_POST["records"])? $_POST["records"] : 5;
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
            // echo '<li class="page-item"><a class="page-link" href="#" onclick="loadPagination('.$i.')">'.$i.'</a></li>';
                }
            echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
            ?>
        </ul>
    </nav>


<table class="table table-hover" id="pagination-container">
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

<script>
function loadPagination(pageNumber) {
  // Send an AJAX request to get_products.php with the page number
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'get_books.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Parse the response as JSON
      var products = JSON.parse(xhr.responseText);
      
      // Update the content of the pagination container
      var container = document.getElementById('pagination-container');
      container.innerHTML = '';
      for (var i = 0; i < products.length; i++) {
        var product = products[i];
        var item = document.createElement('div');
        item.textContent = product.name;
        container.appendChild(item);
      }
    }
  };
  xhr.send('page_number=' + pageNumber);
}
</script>