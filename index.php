<?php
include_once 'linearSearch.php';
include_once 'search.php';
include_once 'sort.php';
include_once 'main.php';


$HotelData = new HotelsData();
$hotels = $HotelData->getAllHotelsData();
$sort = new SortByPrice($HotelData);

$hotels = $sort->sort();


if (isset($_POST['submit'])) {

  $error_fields[] = array();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!(isset($_POST['name']) && !empty($_POST['name']))) {
      $error_fields[] = 'name';
    }
    if (!(isset($_POST['price']) && !empty(trim($_POST['price'])))) {
      $error_fields[] = 'price';
    }
    if (!(isset($_POST['from']) && !empty($_POST['from']) && isset($_POST['to']) && !empty($_POST['to']))) {
      $error_fields[] = 'date';
    }
    if (!(isset($_POST['destination']) && !empty($_POST['destination']))) {
      $error_fields[] = 'destination';
    }
  }
  if (
    !in_array('name', $error_fields) ||
    !in_array('price', $error_fields) ||
    !in_array('date', $error_fields) ||
    !in_array('destination', $error_fields)
  ) {

    $name = cleanStr($_POST['name']);
    $price = cleanPrice($_POST['price']);
    $dateFrom = cleanDate($_POST['from']);
    $dateTo = cleanDate($_POST['to']);
    $destination = cleanStr($_POST['destination']);
    echo $name;
    $search = new Search();

    $hotels = $search->shearchByDate($hotels,$dateFrom, $dateTo);


  } else {
    if (
      in_array('name', $error_fields) ||
      in_array('price', $error_fields) ||
      in_array('date', $error_fields) ||
      in_array('destination', $error_fields)
    )
      echo
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>';

  }

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
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <h1 class="logo me-auto me-lg-0"><a href="/">Hotel</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        
            
            <form  action="index.php" method="POST">
                
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
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>