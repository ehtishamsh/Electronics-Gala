<?php
include 'header.php';
include 'nav.php';
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $sql = "INSERT INTO feedback (name, email, phone, message, timestamp) VALUES ('$name', '$email', '$phone', '$message', NOW())";
  if (mysqli_query($con, $sql)) {
    echo "<script>alert('Thank you for your feedback!');</script>";
  } else {
    echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
  }
}
?>
<div class="container-fluid px-0 p">
  <div class="container feedback-container mb-5 px-0">
    <div class="img-container">
      <h2 class="text-center mb-0">Feedback</h2>
    </div>
    <form method="POST" class="py-4 px-5">
      <div class="mb-3">
        <label for="name" class="form-label f-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter full name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label f-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email address">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label f-label">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter phone number">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label f-label">Message:</label>
        <textarea class="form-control" id="message" name="message" rows="5" required
          placeholder="Your comment..."></textarea>
      </div>
      <button type="submit" class="contact100-form-btn" name="submit">Submit</button>
    </form>
  </div>
</div>
<?php
include 'footer.php';
?>