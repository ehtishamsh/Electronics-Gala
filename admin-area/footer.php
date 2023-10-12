</div>
<div class="clearfix"></div>
<footer class="site-footer">
  <div class="footer-inner bg-white">
    <p>Electronic's Gala &reg;</p>
  </div>
</footer>
</div>
<script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="assets/js/popper.min.js" type="text/javascript"></script>
<script src="assets/js/plugins.js" type="text/javascript"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
<script>
const editResponseButtons = document.querySelectorAll('.edit-response-btn');
const keywordInput = document.getElementById('keywordInput');
const responseInput = document.getElementById('responseInput');
const responseIdInput = document.getElementById('responseId');

editResponseButtons.forEach(button => {
  button.addEventListener('click', function() {
    const keyword = button.dataset.keyword;
    const response = button.dataset.response;
    const id = button.dataset.id;
    keywordInput.value = keyword;
    responseInput.value = response;
    responseIdInput.value = id;
  });
});
</script>
<script>
// JavaScript to handle the delete button click
const deleteButtons = document.querySelectorAll('.delete-btn');
const deleteConfirmedButton = document.querySelector('.delete-confirmed-btn');

deleteButtons.forEach((button) => {
  button.addEventListener('click', function(event) {
    event.preventDefault();
    const deleteLink = this.getAttribute('href');
    deleteConfirmedButton.setAttribute('href', deleteLink);
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get the input element for the product image
  const productImageInput = document.getElementById("productimage");
  // Get the container element for the image preview
  const imagePreviewContainer = document.getElementById("image-preview");

  // Listen for changes in the input element (when a file is selected)
  productImageInput.addEventListener("change", function() {
    // Clear the previous image preview, if any
    imagePreviewContainer.innerHTML = "";

    // Check if a file is selected
    if (productImageInput.files && productImageInput.files[0]) {
      const fileReader = new FileReader();

      // When the file is read, display the preview
      fileReader.onload = function(e) {
        const imagePreview = document.createElement("img");
        imagePreview.setAttribute("src", e.target.result);
        imagePreview.setAttribute("class", "img-fluid mt-2");
        imagePreviewContainer.appendChild(imagePreview);
      };

      // Read the selected file as a data URL
      fileReader.readAsDataURL(productImageInput.files[0]);
    }
  });
});
</script>

</body>

</html>