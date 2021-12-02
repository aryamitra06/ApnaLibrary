<?php
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "apnalibrary";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" 
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="Assets/Images/logo.png" type="image/png">
    <title>ApnaLibrary - Free and Open-source Library Management App</title>
  </head>
  <body>
    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/apnalibrary/" method="post">
    <div class="row">
        <div class="col">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <label for="formGroupExampleInput" class="form-label">Book Title</label>
          <input type="text" class="form-control" placeholder="" aria-label="First name" name="book_title_edit"  id="titleEdit" required>
        </div>
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">ISBN</label>
          <input type="text" class="form-control" placeholder="" aria-label="Last name" name="book_isbn_edit"  id="isbnEdit" required>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">Author</label>
          <input type="text" class="form-control" placeholder="" aria-label="First name" name="book_author_edit"  id="authorEdit" required>
        </div>
        <div class="col mb-4">
            <label for="formGroupExampleInput" class="form-label">Addition Date</label>
          <input type="date" class="form-control" placeholder="" aria-label="Last name" name="book_addition_date_edit"  id="additiondateEdit" required>
        </div>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Description</span>
        <textarea class="form-control" aria-label="With textarea" name="book_description_edit" id="descriptionEdit" required></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
</form>
      </div>
    </div>
  </div>
</div>
<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="Assets/Images/logo.png" alt="" width="30" height="30">
      <a class="navbar-brand" href="#"> &nbsp; ApnaLibrary</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Privacy Policy</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<?php
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $sql = "DELETE FROM `apnalibrary_books` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result)
  {
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Deleted the book.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   ';
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['snoEdit'])){

    $sno = $_POST["snoEdit"];
    $isbn = $_POST["book_isbn_edit"];
    $title = $_POST["book_title_edit"];
    $author = $_POST["book_author_edit"];
    $additiondate = $_POST["book_addition_date_edit"];
    $description = $_POST["book_description_edit"];

    $sql = "UPDATE `apnalibrary_books` SET `book_isbn` = '$isbn' , `book_title` = '$title', `book_author` = '$author', `book_addition_date` = '$additiondate', `book_description` = '$description', `book_isbn`='$isbn' WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Updated the book.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
     ';
    }
  }
  else{
    
    $book_title = $_POST['book_title'];
    $book_isbn = $_POST['book_isbn'];
    $book_author = $_POST['book_author'];
    $book_addition_date = $_POST['book_addition_date'];
    $book_description = $_POST['book_description'];
  
    // SQL command to insert data into the table
  $sql = "INSERT INTO `apnalibrary_books` (`book_title`, `book_isbn`, `book_author`, `book_addition_date`, `book_description`) VALUES ('$book_title', '$book_isbn', '$book_author', '$book_addition_date', '$book_description')";
  
  // Saving the SQL command with SQL database
  $result = mysqli_query($conn, $sql);
  
  if($result)
  {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> New book has been added.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   ';
  }
  }
}
?>

<!--Adding a book to library-->
<div class="container container-addbook">

<h4 class="heading"><i class="fas fa-plus-circle"></i> New Book</h4>
<!--Form that adds new book to the database-->
<form action="/apnalibrary/" method="post">
    <div class="row">
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">Book Title</label>
          <input type="text" class="form-control" placeholder="" aria-label="First name" name="book_title" required>
        </div>
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">ISBN</label>
          <input type="text" class="form-control" placeholder="" aria-label="Last name" name="book_isbn" required>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
            <label for="formGroupExampleInput" class="form-label">Author</label>
          <input type="text" class="form-control" placeholder="" aria-label="First name" name="book_author" required>
        </div>
        <div class="col mb-4">
            <label for="formGroupExampleInput" class="form-label">Addition Date</label>
          <input type="date" class="form-control" placeholder="" aria-label="Last name" name="book_addition_date" required>
        </div>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Description</span>
        <textarea class="form-control" aria-label="With textarea" name="book_description" required></textarea>
      </div>
            <button type="submit" class="btn btn-success float-end">Submit</button> 
</form>
</div>

<!--fetching added books from the database-->

<div class="container book-table">
<table class="table" id="myTable">
<thead>
  <tr>
  <th scope="col">Serial</th>
    <th scope="col">ISBN</th>
    <th scope="col">Book Title</th>
    <th scope="col">Author</th>
    <th scope="col">Addition Date</th>
    <th scope="col">Description</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM `apnalibrary_books`";
$result = mysqli_query($conn, $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result))
{
  $sno = $sno + 1;
 echo "<tr>
    <td> ". $sno . " </td>
    <td> ". $row['book_isbn']." </td>
    <td> ". $row['book_title']." </td>
    <td> ". $row['book_author']." </td>
    <td> ". $row['book_addition_date']." </td>
    <td> ". $row['book_description']." </td>
    <td> <button type='button' class='btn btn-outline-warning btn-sm edit' id=".$row['sno'].">Edit</button> &nbsp; <button type='button' class='delete btn btn-outline-danger btn-sm' id=d".$row['sno'].">Delete</button></td>
  </tr>";
}
?>
</tbody>
</table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/script.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>