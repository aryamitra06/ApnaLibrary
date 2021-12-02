//for DataTable library
$(document).ready( function () {
    $('#myTable').DataTable();
} );

//for bootstrap modal library
$(document).ready(function () {
    $('#myTable').DataTable();

  });

//script for modal
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    tr = e.target.parentNode.parentNode;
    isbn = tr.getElementsByTagName("td")[1].innerText;
    title = tr.getElementsByTagName("td")[2].innerText;
    author = tr.getElementsByTagName("td")[3].innerText;
    additiondate = tr.getElementsByTagName("td")[4].innerText;
    description = tr.getElementsByTagName("td")[5].innerText; 
    titleEdit.value = title;
    isbnEdit.value = isbn;
    authorEdit.value = author;
    additiondateEdit.value = additiondate;
    descriptionEdit.value = description;
    snoEdit.value = e.target.id;
    $('#editModal').modal('toggle');
  })
})

//deleting
deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit ");
    sno = e.target.id.substr(1);

    if (confirm("Are you sure you want to delete this book!")) {
      console.log("yes");
      window.location = `/apnalibrary?delete=${sno}`;
      // TODO: Create a form and use post request to submit a form
    }
    else {
      console.log("no");
    }
  })
})