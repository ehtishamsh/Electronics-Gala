<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_POST['add_response'])) {
  $keyword = $_POST['keyword'];
  $response = $_POST['response'];

  // Add the keyword-response pair to the database
  $sql = "INSERT INTO chat_responses (keyword, response) VALUES ('$keyword', '$response')";
  if ($con->query($sql) === TRUE) {
    echo '<div class="alert alert-success">Keyword and Response added successfully!</div>';
  } else {
    echo '<div class="alert alert-danger">Error: ' . $con->error . '</div>';
  }
} elseif (isset($_POST['edit_response'])) {
  $id = $_POST['response_id'];
  $keyword = $_POST['keyword'];
  $response = $_POST['response'];

  // Update the keyword and response in the database
  $sql = "UPDATE chat_responses SET keyword='$keyword', response='$response' WHERE id=$id";
  if ($con->query($sql) === TRUE) {
    echo '<div class="alert alert-success">Keyword and Response updated successfully!</div>';
  } else {
    echo '<div class="alert alert-danger">Error: ' . $con->error . '</div>';
  }
} elseif (isset($_POST['remove_response'])) {
  $id = $_POST['response_id'];

  // Remove the response from the database
  $sql = "DELETE FROM chat_responses WHERE id=$id";
  if ($con->query($sql) === TRUE) {
    echo '<div class="alert alert-success">Response removed successfully!</div>';
  } else {
    echo '<div class="alert alert-danger">Error: ' . $con->error . '</div>';
  }
}

include 'header.php';
?>

<div class="container mt-2">
  <div class="row mt-4">
    <div class="col-md-6">
      <h4>Add Keyword and Response</h4>
      <form method="post">
        <div class="form-group">
          <label for="keyword">Keyword</label>
          <input type="text" name="keyword" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="response">Response</label>
          <textarea name="response" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" name="add_response" class="btn btn-primary">Add Response</button>
      </form>
    </div>
    <div class="col-md-6">
      <h4>Edit or Remove Responses</h4>
      <?php
      // Fetch all responses from the database
      $sql = "SELECT * FROM chat_responses";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $keyword = $row['keyword'];
          $response = $row['response'];
          ?>
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Keyword:
            <?php echo $keyword; ?>
          </h5>
          <p class="card-text">Response:
            <?php echo $response; ?>
          </p>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary edit-response-btn" data-toggle="modal" data-target="#editModal"
              data-id="<?php echo $id; ?>" data-keyword="<?php echo $keyword; ?>"
              data-response="<?php echo $response; ?>">Edit
            </button>
            <form class="delete-form" method="post">
              <input type="hidden" name="response_id" value="<?php echo $id; ?>">
              <button type="submit" name="remove_response" class="btn btn-danger">Remove</button>
            </form>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        echo '<p>No responses found.</p>';
      }
      ?>
    </div>
  </div>
</div>

<!-- Modal for editing response -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Response</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label for="keyword">Keyword</label>
            <input type="text" name="keyword" class="form-control" id="keywordInput" required>
          </div>
          <div class="form-group">
            <label for="response">Response</label>
            <textarea name="response" class="form-control" rows="4" id="responseInput" required></textarea>
          </div>
          <input type="hidden" name="response_id" id="responseId">
          <button type="submit" name="edit_response" class="btn btn-primary">Save Changes</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>