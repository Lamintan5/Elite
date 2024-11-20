<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Car Rental</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
    
</head>
<body>
    

    <header>
        <h2 class="logo"><span>E</span>lite <span>C</span>ar <span>R</span>ental</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#services">Services</a>
            <a href="#">Reviews</a>
            <a href="#">Contact</a>
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Show Dashboard if user is logged in -->
                <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>
        </nav>
        <?php if (isset($_SESSION['user'])): ?>
            <!-- Show Log out if user is logged in -->
            <a href="logout.php" class="btn-talk">Log out</a>
        <?php else: ?>
            <!-- Show Log in if no user session -->
            <a href="auth.html" class="btn-talk">Log in</a>
        <?php endif; ?>
    </header>

    <section class="home">
        <div class="content">
            <h2>Need to travel in <span>Luxury?</span></h2>
            <p>Choose from our fleet of high-spec vehicles for your next trip to the airport, wedding, or weekend getaway.</p>
            <div class="btn-group">
                <a href="#">Online Booking</a>
            </div>
        </div>
    </section>

    <section id="vehicles" class="vehicles-section">
        <div class="position-relative d-flex align-items-center justify-content-center">
            <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Vehicles</h1>
            <h1 class="position-absolute text-uppercase text-primary color:#7d2ae8">Our Vehicles</h1>
        </div>
        <div class="vehicles-grid">
            <!-- Vehicle cards will be populated here -->
        </div>
    </section>

    <!-- Services Start -->
    <div class="container-fluid pt-5" id="service">
            <div class="container">
                <div class="position-relative d-flex align-items-center justify-content-center">
                    <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Service</h1>
                    <h1 class="position-absolute text-uppercase text-primary color:#7d2ae8">Our Services</h1>
                </div>
                <div class="row pb-3">
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-arrow-up service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Short-Term Car Rentals</h4>
                            <i class="fa-solid fa-down-to-line"></i>
                        </div>
                        <p>Rent a car for a day, weekend, or a few days to meet your short-term transportation needs.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-arrow-down service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Long-Term Car Rentals</h4>
                            
                        </div>
                        <p>Ideal for extended stays, offering discounted rates for rentals lasting weeks or months.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-car service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Luxury Car Rentals</h4>
                            
                        
                        </div>
                        <p>Choose from a selection of high-end vehicles for special events or a premium driving experience.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-plane service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Airport Pickup & Drop-Off</h4>
                            
                        </div>
                        <p>Convenient car rental services directly from the airport, ensuring you have a car as soon as you land.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-road service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">24/7 Roadside Assistance</h4>
                            
                        </div>
                        <p>Peace of mind with round-the-clock support in case of breakdowns or emergencies while on the road.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-map service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">GPS & Car Seat Rentals</h4>
                        
                        </div>
                        <p>Enhance your journey with additional features like GPS navigation systems and child car seats available upon request.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Services End -->
    

    <section class="contact-us">
        <dic class="cotact-us-container">
            <h4>Book Online Today And Travel</h4>
            <h4>In Comfort On Your Next Trip</h4>
            <p>Contact us today and book your next trip using our secure online booking system.</p>
            <a href="#" class="btn-talk">Talk to us</a>
        </dic>

    </section>

    
    <!-- Testimonial Start -->
    <div class="container-fluid py-5" id="testimonial">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Review</h1>
                <h1 class="position-absolute text-uppercase text-primary">Clients Say</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h4 class="font-weight-light mb-4">Dolor eirmod diam stet kasd sed. Aliqu rebum est eos. Rebum elitr dolore et eos labore, stet justo sed est sed. Diam sed sed dolor stet accusam amet eirmod eos, labore diam clita</h4>
                            <img class="img-fluid rounded-circle mx-auto mb-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNBs1Mg71nW8adit7yHWWokb25jXLe1ATFpTWhpl2VZXqnZt6yg52pkslyGQQ5pSYWyvw&usqp=CAU" style="width: 80px; height: 80px;">
                            <h5 class="font-weight-bold m-0">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <section class="faq" id="faq">
                <div class="column">
                    <div class="column reveal">
                        <h1>Frequently Asked Questions</h1> 
                        <h2>Here are some of Frequently Asked Questions from Registered customer’s</h2>
                    </div>
                    <div class="accd-grid">
                        <div class="first-acc"> 
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="first">
                                    <label for="first">What are the requirements to rent a car?</label>
                                    <div class="content">
                                        <p>
                                        To rent a car, you must be at least 21 years old (some locations may require you to be 25 or older). A valid driver's license, a credit or debit card in your name, and proof of insurance are also required. Please check your rental location for any specific additional requirements.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="second">
                                    <label for="second">Can I rent a car with a debit card?</label>
                                    <div class="content">
                                        <p>
                                        Yes, you can rent a car with a debit card, but certain restrictions may apply. Some locations may require additional documentation, such as proof of return travel or a credit check. Please contact the rental office in advance to confirm their debit card policy.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="third">
                                    <label for="third">What is the cancellation policy?</label>
                                    <div class="content">
                                        <p>
                                        You can cancel your reservation up to 24 hours before the pickup time for a full refund. Cancellations made less than 24 hours before the pickup time may incur a fee. Please refer to our specific terms and conditions for more details on cancellation fees and policies.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="fourth">
                                    <label for="fourth"> Is insurance included with my rental?</label>
                                    <div class="content">
                                        <p>
                                        Our rental rates do not include insurance by default. However, we offer various optional insurance coverage packages to ensure your peace of mind while driving. You can choose the coverage that best fits your needs when booking or upon arrival at the rental location.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="second-acc">
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="fifth">
                                    <label for="fifth"> Can I extend my car rental period?</label>
                                    <div class="content">
                                        <p>
                                        Yes, you can extend your rental period. Please contact the rental location as soon as possible to request an extension. Extension availability is subject to vehicle availability, and additional charges may apply.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="sixth">
                                    <label for="sixth">What should I do if I have an accident or breakdown with the rental car?</label>
                                    <div class="content">
                                        <p>
                                        In the event of an accident or breakdown, please contact our customer service team immediately for assistance. We will provide you with instructions on how to proceed and arrange for a replacement vehicle if necessary. You should also report the incident to local authorities and follow the insurance procedures outlined in your rental agreement.
                                        These FAQs should cover some of the most common questions customers have when renting a car. Let me know if you need to customize them further!
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="seventh">
                                    <label for="seventh">Can I drive the rental car outside of the country?</label>
                                    <div class="content">
                                        <p>
                                        In most cases, our vehicles are not permitted to be driven outside of the country without prior approval. If you plan to drive across borders, please inform us at the time of booking. Additional insurance coverage and fees may apply, and certain locations may have restrictions on where the car can be taken.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="eigth">
                                    <label for="eigth">What happens if I return the car late?</label>
                                    <div class="content">
                                        <p>
                                        If you return the car later than the scheduled time, additional charges may apply. The rental company typically charges a late fee for each hour or day beyond the agreed return time. To avoid extra charges, please return the vehicle on time or notify us in advance if you need an extension.
                                        These two additional FAQs will help address concerns about international travel and late returns. Let me know if you need further adjustments!
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
    </section>


    <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify"><strong>Elite Car Rental Hire Payment System</strong>  Rental provides affordable and convenient car hire service within Kenya and East Africa. We have a wide range of low-cost vehicles and applications for rent to suit your each need. <a href="https://studio5ive.org">www.studio5ive.org</a></p>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Categories</h6>
                <div class="contact-row">
                    <i class="fa-solid fa-location-dot"></i>
                    <p> Nyayo Estate, Embakasi P.O Box 52196-00100 Nairobi</p>
                </div>
                <div class="contact-row">
                    <i class="fa-solid fa-envelope"></i>
                    <p> info@elite.com</p>
                </div>
                <div class="contact-row">
                <i class="fa-solid fa-phone"></i>
                    <p> +254712345678</p>
                </div>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                <li><a href="http://scanfcode.com/about/">About Us</a></li>
                <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
                <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Contribute</a></li>
                <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
                <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
                </ul>
            </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
                <a href="https://studio5ive.org">studio5ive.org</a>
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a class="twitter" href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a class="linkedin" href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>   
                </ul>
            </div>
            </div>
        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
