<?php
include("../core/config.php");

$query = "SELECT ID, Title, Department, Name, Author, Copy_date, No_copies, Isbn FROM book";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
?>
  <!-- Edit Modal for Book ID: <?php echo $row['ID']; ?> -->
  <div class="modal fade" id="editModal<?php echo $row['ID']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['ID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel<?php echo $row['ID']; ?>">Edit Book - <?php echo $row['Title']; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../utilities/crud.php" method="POST">
            <input type="hidden" name="book_id" value="<?php echo $row['ID']; ?>">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" value="<?php echo $row['Title']; ?>">
            </div>
            <!-- Add other fields like Department, Author, etc. here -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="edit_book" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
