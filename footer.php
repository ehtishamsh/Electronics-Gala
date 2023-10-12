<footer class="navbar-fixed-bottom">
  <div class="container custom-container">
    <div class="row no-gutters_footer justify-content-between">
      <div class="col-lg-3 col-sm-6">
        <div class="single-box d-flex flex-column gap-3">
          <img src="images/logo.png" alt="" class="logo-footer" />
          <p class="brand-bio">
            Electronic's Gala is a premier online destination for all your
            electronic needs. With a vast collection of cutting-edge
            gadgets, appliances, and accessories, we offer a seamless
            shopping experience, unbeatable prices, and exceptional customer
            service. Explore the digital realm and embark on a
            technology-filled journey at Electronic's Gala.
          </p>
          <h3 class="we-accept">We Accept:</h3>
          <div class="card-area d-flex gap-3 align-items-center mb-2">
            <img src="images/payments_img/jazz-cash-seeklogo.com.png" alt="" />
            <img src="images/payments_img/74f9da7c-e9b9-4b69-9bcb-dec45e52467b.png" alt="" />
            <img src="images/payments_img/mastercard-26128.png" alt="" />
            <img src="images/payments_img/visa-logo-png-2020.png" alt="" />
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single-box">
          <h3>Information</h3>
          <ul>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="terms.php">Terms & Conditions</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single-box">
          <h3>My Account</h3>
          <ul>
            <li><a href="account.php">Profile</a></li>
            <li><a href="cus_order.php">My Orders</a></li>
            <li><a href="cart.php">My Cart</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single-box-news d-flex flex-column gap-4">
          <h2>Newsletter</h2>
          <p>
            Get E-mail updates about our latest shop and
            <span>special offers.</span>
          </p>
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Enter your email address"
                aria-label="Enter your email address" aria-describedby="basic-addon2" />
              <input type="submit" value="Sign Up" class="input-group-text submit_newsletter" />
            </div>
          </form>
          <h3>Follow Us:</h3>
          <div class="follow-logo d-flex align-items-center gap-3">
            <img src="images/social-media/fb.png" alt="" />
            <img src="images/social-media/yt.png" alt="" />
            <img src="images/social-media/insta.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<section class="head">
  <div class="container d-flex justify-content-center py-1 head_container">
    <div class="head-row d-flex gap-4">
      <div class="phone">
        <p>Developed by Bc190405810</p>
      </div>
      <div class="mail">
        <p>Virtual University of Paksitan</p>
      </div>
    </div>
  </div>
</section>
<!-- Chatbox Icon -->
<div class="chat-icon" onclick="toggleChatBox()">
  <i class="bi bi-chat-dots-fill"></i>
</div>

<div class="chat-box hide">
  <div class="header">
    <div class="title">Chat with Virtual Assistant</div>
    <button class="btn-close" onclick="closeChatBox()">
      <i class="bi bi-x"></i>
    </button>
  </div>
  <div class="messages"></div>
  <div class="input">
    <input type="text" placeholder="Type your message here" onkeydown="handleEnterKey(event)" />
    <button class="send-btn" onclick="sendMessage()">
      <i class="bi bi-arrow-right-circle-fill"></i>
    </button>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
  integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll('[data-mdb-toggle="pill"]');
    const tabContents = document.querySelectorAll(".tab-pane");

    tabs.forEach(function (tab) {
      tab.addEventListener("click", function (event) {
        event.preventDefault();

        // Remove active class from all tabs
        tabs.forEach(function (t) {
          t.classList.remove("active");
        });

        // Add active class to the clicked tab
        this.classList.add("active");

        // Hide all tab contents
        tabContents.forEach(function (content) {
          content.classList.remove("show", "active");
        });

        // Show the selected tab content
        const target = this.getAttribute("data-mdb-target");
        document.querySelector(target).classList.add("show", "active");
      });
    });
  });
</script>
<script>
  const rangeInput = document.querySelectorAll(".range-input input");
  const priceInput = document.querySelectorAll(".price-input input");
  const range = document.querySelector(".slider .progress");

  let priceGap = 1000;

  priceInput.forEach(input => {
    input.addEventListener("input", e => {
      let minPrice = parseInt(priceInput[0].value);
      let maxPrice = parseInt(priceInput[1].value);

      if (maxPrice > rangeInput[1].max) {
        maxPrice = rangeInput[1].max;
        priceInput[1].value = maxPrice;
      }

      if ((maxPrice - minPrice >= priceGap)) {
        rangeInput[0].value = minPrice;
        rangeInput[1].value = maxPrice;
        range.style.left = `${((minPrice / rangeInput[0].max) * 100)}%`;
        range.style.right = `${100 - ((maxPrice / rangeInput[1].max) * 100)}%`;
      }
    });
  });

  rangeInput.forEach(input => {
    input.addEventListener("input", e => {
      let minVal = parseInt(rangeInput[0].value);
      let maxVal = parseInt(rangeInput[1].value);

      if ((maxVal - minVal) < priceGap) {
        if (e.target.className === "range-min") {
          rangeInput[0].value = maxVal - priceGap;
        } else {
          rangeInput[1].value = minVal + priceGap;
        }
      }

      priceInput[0].value = rangeInput[0].value;
      priceInput[1].value = rangeInput[1].value;
      range.style.left = `${((minVal / rangeInput[0].max) * 100)}%`;
      range.style.right = `${100 - ((maxVal / rangeInput[1].max) * 100)}%`;
    });
  });
</script>
<script>
  function sortProducts() {
    // Get the selected sorting option
    var sortOption = document.getElementById('sort').value;

    // Get the product list container element
    var productList = document.querySelector('.product-list');

    // Get all the product elements
    var products = productList.querySelectorAll('.product-col');

    // Convert the NodeList to an array for easier manipulation
    var productsArray = Array.from(products);

    // Sort the products based on the selected option
    if (sortOption === 'low-to-high-price') {
      productsArray.sort(function (a, b) {
        var priceA = parseInt(a.querySelector('.price p').textContent);
        var priceB = parseInt(b.querySelector('.price p').textContent);
        return priceA - priceB;
      });
    } else if (sortOption === 'high-to-low-price') {
      productsArray.sort(function (a, b) {
        var priceA = parseInt(a.querySelector('.price p').textContent);
        var priceB = parseInt(b.querySelector('.price p').textContent);
        return priceB - priceA;
      });
    } else if (sortOption === 'most-rated') {
      // Add your own logic here to sort by top rated
    }

    // Remove existing product elements from the container
    products.forEach(function (product) {
      productList.removeChild(product);
    });

    // Append the sorted product elements back to the container
    productsArray.forEach(function (product) {
      productList.appendChild(product);
    });
  }
</script>
<script>
  $(document).ready(function () {
    $('#staticBackdrop').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var paymentMethod = $('input[name="payment"]:checked').val();

      // Check if payment method is "Credit/Debit" before displaying credit card information
      if (paymentMethod === 'Credit/Debit') {
        var cardNumber = $("#cardNumber").val();
        var cardName = $("#cardName").val();
        var expiryDate = $("#expiryDate").val();
        var cvv = $("#cvv").val();
        var modal = $(this);
        modal.find('.pay-ment').html('<p>Payment method selected:Credit Card</p><br><p>Card Number: ' +
          cardNumber + '</p><p>Cardholder Name: ' + cardName +
          '</p><p>Expiry Date: ' + expiryDate + '</p><p>CVV: ' + cvv + '</p>');
      } else {
        // If payment method is "Cash on Delivery", show a message
        var modal = $(this);
        modal.find('.pay-ment').html('<p>Payment method selected: Cash on Delivery</p>');
      }
    });
  });
</script>
<script>
  // Event listener to show/hide credit card fields based on payment selection
  const paymentRadios = document.querySelectorAll('input[name="payment"]');
  const creditCardFields = document.getElementById('creditCardFields');

  paymentRadios.forEach((radio) => {
    radio.addEventListener('change', function () {
      if (this.value === 'Credit/Debit') {
        creditCardFields.style.display = 'block';
      } else {
        creditCardFields.style.display = 'none';
      }
    });
  });
</script>
<script>
  document.getElementById('decreaseQuantity').addEventListener('click', function () {
    var quantityInput = document.querySelector('.quantity-design');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });

  document.getElementById('increaseQuantity').addEventListener('click', function () {
    var quantityInput = document.querySelector('.quantity-design');
    var currentValue = parseInt(quantityInput.value);
    var stockQty = <?php echo $stockQty; ?>; // Get the stock quantity from PHP variable

    if (currentValue < stockQty) { // Check if current value is less than stock quantity
      quantityInput.value = currentValue + 1;
    }
  });
</script>

<script>
  const dropdownNavItem = document.querySelector(".nav-item.dropdown");
  const dropdownMenu = document.querySelector(".dropdown-menu-nav");

  dropdownNavItem.addEventListener("mouseenter", () => {
    dropdownMenu.style.display = "block";
    dropdownMenu.classList.remove("slide-up");
  });

  dropdownNavItem.addEventListener("mouseleave", () => {
    dropdownMenu.classList.add("slide-up");
  });
</script>
<script>
  const subMenus = document.querySelectorAll(".sub-menu");
  subMenus.forEach((menu) => {
    menu.addEventListener("transitionend", () => {
      if (menu.style.display === "none") {
        menu.style.display = "";
      }
    });
  });
</script>
<script>
  const chatIcon = document.querySelector(".chat-icon");
  const chatBox = document.querySelector(".chat-box");
  const messagesContainer = document.querySelector(".messages");
  const input = document.querySelector(".input input");

  // Open chat box
  function toggleChatBox() {
    chatBox.classList.add("show");
  }

  // Close chat box
  function closeChatBox() {
    chatBox.classList.add("hide");
    chatBox.classList.remove("show");
  }

  // Send message
  function sendMessage() {
    const message = input.value.trim();
    if (message !== "") {
      displayMessage("customer", message);

      // Show typing indicator
      displayTypingIndicator();

      // Process customer message with a delay
      setTimeout(() => {
        processCustomerMessage(message);
      }, 1000);

      input.value = "";
      scrollToBottom();
    }
  }

  // Process customer message and provide response
  function processCustomerMessage(message) {
    // Use AJAX to fetch keywords and responses from the server
    $.ajax({
      url: "responses.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        // Split the user's message into individual words
        const words = message.toLowerCase().split(/\s+/);

        // Check if any keyword from the database matches the user's message
        const matchedKeywords = Object.keys(data).filter((keyword) => {
          // Convert the keyword and message words into sets for comparison
          const keywordSet = new Set(keyword.toLowerCase().split(/\s+/));
          const messageSet = new Set(words);

          // Check if all words from the keyword are present in the message together
          return Array.from(keywordSet).every((word) => messageSet.has(word));
        });

        // If a keyword is found, use its corresponding response
        if (matchedKeywords.length > 0) {
          const response = data[matchedKeywords[0]];
          displayMessage("assistant", response);
        } else {
          // If no keyword match is found, display a default response
          const defaultResponse =
            "I'm sorry, but I'm not sure how to assist with that. Can you please provide more information?";
          displayMessage("assistant", defaultResponse);
        }
        removeTypingIndicator();
      },
      error: function () {
        // Handle error if fetching responses fails
        const response =
          "I'm sorry, but there was an error while processing your request. Please try again later.";
        displayMessage("assistant", response);
        removeTypingIndicator();
      },
    });
  }



  // Display message in the chat box
  function displayMessage(sender, message) {
    const messageEl = document.createElement("div");
    messageEl.classList.add(
      "message",
      sender === "customer" ? "customer" : "assistant"
    );
    messageEl.innerHTML = `
        <div class="avatar">${sender === "customer" ? "You" : "VA"}</div>
        <div class="text">${message}</div>
      `;
    messagesContainer.appendChild(messageEl);
  }

  // Display typing indicator
  function displayTypingIndicator() {
    const typingIndicatorEl = document.createElement("div");
    typingIndicatorEl.classList.add("message", "typing-indicator");
    typingIndicatorEl.innerHTML = `
        <div class="avatar">VA</div>
        <div class="text">...</div>
      `;
    messagesContainer.appendChild(typingIndicatorEl);
  }

  // Remove typing indicator
  function removeTypingIndicator() {
    const typingIndicatorEl = document.querySelector(".typing-indicator");
    if (typingIndicatorEl) {
      typingIndicatorEl.remove();
    }
  }

  // Scroll to bottom of messages
  function scrollToBottom() {
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  // Show welcome message from virtual assistant
  const welcomeMessageEl = document.createElement("div");
  welcomeMessageEl.classList.add("message");
  welcomeMessageEl.innerHTML = `
      <div class="avatar">VA</div>
      <div class="text">Hello! How can I help you today?</div>
    `;
  messagesContainer.appendChild(welcomeMessageEl);
  scrollToBottom();

  // Handle Enter key press
  function handleEnterKey(event) {
    if (event.key === "Enter") {
      sendMessage();
    }
  }
</script>
<script>
  // JavaScript for showing/hiding the password fields with animations
  const toggleButton = document.getElementById('togglePasswordFields');
  const passwordFields = document.getElementById('passwordFields');

  toggleButton.addEventListener('click', () => {
    passwordFields.classList.toggle('show');
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('updateModal');
    var countdownElement = document.getElementById('countdown');

    function showModal() {
      modal.style.display = 'block';
    }

    function hideModal() {
      modal.style.display = 'none';
    }

    function updateCountdown() {
      var countdown = parseInt(countdownElement.textContent, 10);
      countdown--;
      countdownElement.textContent = countdown;

      if (countdown <= 0) {
        window.location.href = "cus_information.php";
      } else {
        setTimeout(updateCountdown, 1000); // Update every 1 second (1000 ms)
      }
    }

    showModal();
    updateCountdown();
  });
</script>
<script>
  // Show message popup and hide after a few seconds
  window.onload = function () {
    var popup = document.getElementById("popup");
    setTimeout(function () {
      popup.style.display = "none";
    }, 3000);
  };
</script>
<script>
  // Function to show the error message
  function showError() {
    document.querySelector('.alert-danger').style.display = 'block';
  }

  // Function to hide the error message
  function hideError() {
    document.querySelector('.alert-danger').style.display = 'none';
  }

  // Show the error message initially if it exists
  if (document.querySelector('.alert-danger')) {
    showError();
    // Hide the error message after 5 seconds (5000 milliseconds)
    setTimeout(hideError, 5000);
  }
</script>
<?php
if (isset($_SESSION['cart_Dmessage'])) {
  $message = $_SESSION['cart_Dmessage'];
  unset($_SESSION['cart_Dmessage']); // Clear the session variable

  echo "<script>
            Swal.fire({
                icon: 'error',
                text: '" . $message . "',
                timer: 1500, // Auto close after 3 seconds
                showConfirmButton: false,
                customClass: {
                  popup: 'custom-swal-popup' // Apply the custom class to the pop-up
              }
            });
        </script>";
}
?>

<?php
if (isset($_SESSION['cart_message'])) {
  $message = $_SESSION['cart_message'];
  unset($_SESSION['cart_message']); // Clear the session variable

  echo "<script>
            Swal.fire({
              icon: '" . (strpos($message, 'Insufficient') !== false ? 'warning' : 'success') . "',
                text: '" . $message . "',
                timer: 1500, // Auto close after 3 seconds
                width: '350px',
                showConfirmButton: false,
                customClass: {
                  popup: 'custom-swal-popup' // Apply the custom class to the pop-up
              }
            });
        </script>";
}
?>

<script>
  // JavaScript code to scroll to the "cart items" section on page load
  document.addEventListener("DOMContentLoaded", function () {
    const cartItemsSection = document.getElementById("cart-items");
    if (cartItemsSection) {
      cartItemsSection.scrollIntoView({
        behavior: "smooth"
      });
    }
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const unblurElements = document.querySelectorAll(".blur");
    const triggerOffset = 300; // Adjust this offset as needed

    function isInViewport(element) {
      const rect = element.getBoundingClientRect();
      return (
        rect.top <= window.innerHeight - triggerOffset && rect.bottom >= 0
      );
    }

    function handleScroll() {
      unblurElements.forEach((element) => {
        if (isInViewport(element)) {
          element.classList.add("unblurred");
        }
      });
    }

    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial check
  });
</script>
<script>
  let thumb = "<?php echo $thumb ?>";
  let img2 = document.querySelector("#img-2");
  img2.style.backgroundImage = `url("admin-area/product_images/${thumb}")`;

  document.querySelector("#img-zoomer-box").addEventListener(
    "mousemove",
    function (e) {
      let original = document.querySelector("#img-1"),
        magnified = img2,
        style = magnified.style,
        x = e.pageX - this.offsetLeft,
        y = e.pageY - this.offsetTop,
        imgWidth = original.offsetWidth,
        imgHeight = original.offsetHeight,
        xperc = (x / imgWidth) * 100,
        yperc = (y / imgHeight) * 100;

      // Adjust the background size to zoom in
      style.backgroundSize = "250% 250%";

      //lets user scroll past right edge of image
      if (x > 0.01 * imgWidth) {
        xperc += 0.15 * xperc;
      }

      //lets user scroll past bottom edge of image
      if (y >= 0.01 * imgHeight) {
        yperc += 0.15 * yperc;
      }

      style.backgroundPositionX = xperc - 9 + "%";
      style.backgroundPositionY = yperc - 9 + "%";

      style.left = x - 180 + "px";
      style.top = y - 180 + "px";
    },
    false
  );
</script>
<!-- Message Popup -->
<div id="popup" class="alert alert-success fixed-bottom text-center" style="display: none;">
  Address updated successfully.
</div>
</body>

</html>