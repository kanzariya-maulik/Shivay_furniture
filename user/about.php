<?php
include_once("userheader.php");
?>
<style>
    body{
        background-color: lightpink;
    }
</style>
<div class="about">
        <h1>Our team</h1>
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            
            <div class="carousel-inner">
              
              <div class="carousel-item active" data-bs-interval="2000">
                <img src="../img/ceo/founder1.jpeg" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress">CEO of company</h5>
                  <p class="ress">The CEO is the person who is ultimately accountable for a company's business decisions, including those in operations, marketing, business development, finance, human resources, etc.</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="../img/ceo/1.jpg" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress">Manager of company</h5>
                  <p class="ress">Managers are responsible for achieving the goals and objectives of an organisation through managing its resources (human, financial, and operational).</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../img/ceo/2.jpg" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress">Employee of the month</h5>
                  <p class="ress">An employee is an individual who works for an employer in return for compensation, while an employer is a person or company that hires an employee to perform tasks.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

<?php
include_once("footer.php");
?>