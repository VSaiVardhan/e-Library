<?php 
session_start();

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Store</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		  <a class="navbar-brand" href="index.php" style="font-weight: bold; font-size: 1.5rem; color: #007bff; font-style: italic;">WEB GRANTHA</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" 
		             aria-current="page" 
		             href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="#">Help</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="#">About us</a>
		        </li>
		        <li class="nav-item">
		          <?php if (isset($_SESSION['user_id'])) {?>
		          	<a class="nav-link" 
		             href="admin.php">Admin</a>
		          <?php }else{ ?>
		          <a class="nav-link" 
		             href="login.php">Admin Login</a>
		          <?php } ?>

		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<form action="search.php"
     method="get">
  <div class="d-flex justify-content-center align-items-center" style="height: 80px;">
    <div class="input-group">
      <input type="text" 
             class="form-control"
             name="key" 
             placeholder="Search Book..." 
             aria-label="Search Book..." 
             aria-describedby="basic-addon2">

      <button class="input-group-text btn btn-primary" 
              id="basic-addon2">
        <img src="img/search.png"
             width="20">
      </button>
    </div>
  </div>
</form>
<div class="d-flex pt-1">
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			    There is no book in the database
		       </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($books as $book) { ?>
				<div class="card m-1">
					<img src="uploads/cover/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$book['title']?>
						</h5>
						<p class="card-text">
							<i><b>By:
								<?php foreach($authors as $author){ 
									if ($author['id'] == $book['author_id']) {
										echo $author['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
							<?=$book['description']?>
							<br><i><b>Category:
								<?php foreach($categories as $category){ 
									if ($category['id'] == $book['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
                       <a href="uploads/files/<?=$book['file']?>"
                          class="btn btn-success">Open</a>

                        
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="container-for-dropdowns">
		<div class="container-for-dropdowns">
		<div class="category">
		<div class="container-for-dropdowns">
    <!-- Categories/Genres Dropdown -->
    <div class="mb-3">
        <a href="#" class="list-group-item list-group-item-action active">Categories/Genres</a>
        <select name="book_category" class="form-control">
            <option value="0">Select</option>
            <?php 
            if ($categories != 0) {
                foreach ($categories as $category) {
                    $selected = ($category_id == $category['id']) ? 'selected' : '';
                    echo "<option value=\"{$category['id']}\" {$selected}>{$category['name']}</option>";
                }
            }
            ?>
        </select>
    </div>

    <!-- Authors Dropdown -->
    <div class="mb-3">
        <a href="#" class="list-group-item list-group-item-action active">Authors</a>
        <select name="book_author" class="form-control">
            <option value="0">Select</option>
            <?php 
            if ($authors != 0) {
                foreach ($authors as $author) {
                    $selected = ($author_id == $author['id']) ? 'selected' : '';
                    echo "<option value=\"{$author['id']}\" {$selected}>{$author['name']}</option>";
                }
            }
            ?>
        </select>
    </div>
</div>
	

			
		</div>
		</div>
	</div>
</body>
</html>