<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electronic's Gala</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .confirmation-container {
      text-align: center;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #007bff;
    }

    p {
      margin-top: 10px;
      font-size: 18px;
    }
  </style>
  <link rel="icon" type="image/x-icon" href="images/favicon.png">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="confirmation-container">
          <img src="images/logo.png" alt="" style="width:150px">
          <h2>Your Order is Confirmed!!!</h2>
          <p>Thank you for your purchase! Your order has been successfully placed.</p>
          <p>You will be redirected to the order details page in <span id="countdown">5</span> seconds...</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    var countdownValue = 5; // Initial countdown value
    var countdownElement = document.getElementById('countdown');

    function updateCountdown() {
      countdownValue -= 1;
      countdownElement.textContent = countdownValue;

      if (countdownValue === 0) {
        window.location.href = 'view-order.php?id=<?php echo $_GET['orderid']; ?>';
      }
    }

    // Update the countdown every second
    setInterval(updateCountdown, 1000);
  </script>
</body>

</html>