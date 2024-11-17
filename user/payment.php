<?php
include_once("userheader.php");
?>
<style>
    .main{
        background: linear-gradient(rgb(80,80,80),rgb(172, 219, 223),rgb(152, 199, 210));
    }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#payment-form').submit(function(event) {
        
        let formIsValid = true;

        $('.form-text.text-danger').text('');

        const name = $('#card-name');
        if (!name.val().trim()) {
            $('#card-name-error').text('Please enter the name on card.');
            formIsValid = false;
        }

        const number = $('#card-number');
        if (!number.val().trim() || number.val().length !== 16) {
            $('#card-number-error').text('Please enter a valid 16-digit card number.');
            formIsValid = false;
        }

        const expMonth = $('#expiration-month');
        if (!expMonth.val().trim() || expMonth.val() < 1 || expMonth.val() > 12) {
            $('#expiration-month-error').text('Please enter a valid expiration month.');
            formIsValid = false;
        }

        const expYear = $('#expiration-year');
        if (!expYear.val().trim() || expYear.val().length !== 4) {
            $('#expiration-year-error').text('Please enter a valid expiration year.');
            formIsValid = false;
        }

        const cvv = $('#cvv');
        if (!cvv.val().trim() || cvv.val().length < 3) {
            $('#cvv-error').text('Please enter a valid CVV.');
            formIsValid = false;
        }

        if (!formIsValid) {
            event.preventDefault();
        }
    });
});
</script>
      <div class="main">
    <div class="container mt-5">
        <h1 style="text-decoration: underline;">Payment Form</h1><br>
        <form id="payment-form">
          <div class="mb-3">
              <label for="card-name" class="form-label">Name on Card</label>
              <input type="text" class="form-control" id="card-name">
              <div id="card-name-error" class="form-text text-danger"></div>
          </div>
          <div class="mb-3">
              <label for="card-number" class="form-label">Card Number</label>
              <input type="text" class="form-control" id="card-number" inputmode="numeric">
              <div id="card-number-error" class="form-text text-danger"></div>
          </div>
          <div class="row g-3">
              <div class="col-md-4">
                  <label for="expiration-month" class="form-label">Expiration Month</label>
                  <input type="text" class="form-control" id="expiration-month" inputmode="numeric">
                  <div id="expiration-month-error" class="form-text text-danger"></div>
              </div>
              <div class="col-md-4">
                  <label for="expiration-year" class="form-label">Expiration Year</label>
                  <input type="text" class="form-control" id="expiration-year" inputmode="numeric">
                  <div id="expiration-year-error" class="form-text text-danger"></div>
              </div>
              <div class="col-md-4">
                  <label for="cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cvv" inputmode="numeric">
                  <div id="cvv-error" class="form-text text-danger"></div>
              </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
      </form>      
    </div>
      </div>
      <?php
      include_once("footer.php");
      ?>
</body>
</html>

