<?php
include 'vendor/autoload.php';
use App\Hotels;
use App\SortByName;
use App\SortByPrice;




$HotelData = new Hotels(); 
$hotels = $HotelData->getHotels(); 
$sort = new SortByName($hotels);// sort by name 
$hotels = $sort->sort(); 


$errors ;

if (isset($_GET['hotels'])) {
  
  $hotels = json_decode(base64_decode(urldecode($_GET["hotels"])));
  $sort = new SortByPrice($hotels); // sort by price 
  $hotels = $sort->sort();
} else if(isset($_GET['error'])){
      $errors = 'your Search Not valide You should Enter At lest one Filed try again.';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Search About Hotel </title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="src/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="src/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="src/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="src/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="src/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="src/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="src/assets/css/style.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <h1 class="logo me-auto me-lg-0"><a href="/">Hotel</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        
            
            <form  action="src/Submit.php" method="POST">
                
                <ul>
                    
                    <li><input type="text" class="form-control mb-2 mr-sm-2" name="name" id="name" placeholder="Search By Hotel Name" /></li>
                    <li><input type="text" class="form-control mb-2 mr-sm-2" name="price" id="" placeholder="Search By Price $10:$500" /></li>
                    <li><input type="text" class="form-control mb-2 mr-sm-2" name="destination" id="destination" placeholder="Search By Destination" /></li>
                    <li><input type="date" class="form-control mb-2 mr-sm-2" name="from" id="form" placeholder="Search By Start Date" /></li>
                    <li><input type="date" class="form-control mb-2 mr-sm-2" name="to" id="to" placeholder="Search By End Date" /></li>
                    
                    <li><button type="submit" class="btn btn-outline-primary mb-2" name="submit" value="Register">Search</button> 
                    
                  </li>
                </ul>
                
                </form>

            
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        
      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">


    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      

      <div class="container" data-aos="fade-up">
        
        <?php if (isset($errors)) { ?>
          
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Erros In Your Search</strong>
            <?php echo $errors; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
      </div>
        <div class="section-title">
          <h2>Hotels Data</h2>
          <p>All Hotels sorted by name </p>
        </div>
        
        <div class="row">
          <div class="col-lg-6">
            
            <?php foreach($hotels as $hotel){  ?>

            <h3 class="resume-title"><?php echo $hotel->name; ?></h3>
            <div class="resume-item pb-0">
              <h4><?php echo  $hotel->city; ?></h4>
              <p><em>Price of this Hotel <?php echo $hotel->price; ?></em></p>
              <p>
              <ul>
                <?php foreach ($hotel->availability as $availability) { ?>
                        
               <li>Availabil From <?php echo $availability->from ." To ". $availability->to; ?> </li>
               
                
                <?php } ?>
              </ul>
              </p>
            </div>
            <?php } ?>
          </div>
          
          
        </div>

      </div>
    </section><!-- End Resume Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Alaa</span></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="src/src/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="src/src/assets/vendor/aos/aos.js"></script>
  <script src="src/src/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="src/src/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="src/src/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="src/src/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="src/src/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="src/src/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="src/assets/js/main.js"></script>

</body>

</html>