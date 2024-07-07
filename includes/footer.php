<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid ">
        <!-- Footer -->
        <footer class="text-center">
          <!-- Grid container -->
          <div class="container">
            <!-- Section: Links -->
            <section class="mt-2">
              <!-- Grid row-->
              <div class="row text-center d-flex justify-content-center pt-5">
                <!-- Grid column -->
                <div class="col-md-3">
                  <h6 class="text-uppercase ">
                    <a href="index.php" class="text-blue footer-link">Home Page</a>
                  </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2">
                  <h6 class="text-uppercase ">
                    <a href="shop.php" class="text-blue footer-link">Shop</a>
                  </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4">
                  <h6 class="text-uppercase ">
                    <a href="aboutUs.php" class="text-blue footer-link">About us</a>
                  </h6>
                </div>
                <!-- Grid column -->
                <div class="col-md-3">
                  <h6 class="text-uppercase ">
                    <a href="contact-page.php" class="text-blue footer-link">Contact</a>
                  </h6>
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-2" />

            <!-- Section: Text -->
            <section class="mb-2">
              <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                  <p>
                    We are the music makers, and we are the dreamers of dreams
                  </p>
                </div>
              </div>
            </section>
            <!-- Section: Text -->

            <!-- Section: Social -->
            <section class="text-center mb-2">
              <a href="https://www.facebook.com/WonkaMovie/" class="text-black me-4">
                <i class="fab fa-facebook-f fa-2x"></i>
              </a>
              <a href="" class="text-black me-4">
                <i class="fab fa-twitter fa-2x"></i>
              </a>
              <a href="" class="text-black me-4">
                <i class="fab fa-google fa-2x"></i>
              </a>
              <a href="" class="text-black me-4">
                <i class="fab fa-instagram fa-2x"></i>
              </a>
              <a href="" class="text-black me-4">
                <i class="fab fa-linkedin fa-2x"></i>
              </a>
              <a href="" class="text-black me-4">
                <i class="fab fa-github fa-2x"></i>
              </a>
            </section>
            <!-- Section: Social -->
          </div>
          <!-- Grid container -->

          
          <!-- Copyright -->
        </footer>
        <!-- Footer -->
      </div>
      <!-- End of .container -->
</body>
</html>
<style>
    footer .container {
            position: relative;
            font-family: 'WonkaFonts', sans-serif;
            letter-spacing: 10px;
            width: 100%;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        footer .container::before {
            content: '';
            background-size: cover;
            background-color: white;
            opacity: 0.7; 
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            margin:-15px!important;
        }

        @font-face {
            font-family: 'WonkaFonts';
            src: url('fonts/WillyWonka.ttf') format('truetype');

        }

        .footer-link {
            font-size: 22px; 
            color: black;
            
        }

        p {
            font-size: 25px;
            color: blue;
        }
</style>
