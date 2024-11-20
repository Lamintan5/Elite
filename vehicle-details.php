<?php
session_start();

// Assuming user ID is stored in the session after login
$userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
$name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
    <title>Elite Car Rental</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <style>
    .rental-form-container {
        margin: 40px 100px;
        padding: 15px;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        
    }

    .rental-form-container h3 {
        margin-bottom: 10px;
    }

    #rental-form label {
        display: block;
        margin: 8px 0 4px;
        font-weight: bold;
    }

    #rental-form input {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #rental-form select {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .book-btn {
        background-color: #7d2ae8;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .book-btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div id="vehicle-details" class="details-container">
        <h2>Loading vehicle details...</h2>
    </div>

    <header>
    <h2 class="logo"><span>E</span>lite <span>C</span>ar <span>R</span>ental</h2>
    
    <?php if (isset($_SESSION['user'])): ?>
        <!-- Show Log out if user is logged in -->
        <a href="logout.php" class="btn-talk">Log out</a>
    <?php else: ?>
        <!-- Show Log in if no user session -->
        <a href="auth.html" class="btn-talk">Log in</a>
    <?php endif; ?>
</header>
<div class="rental-form-container">
    <h3>Book This Vehicle</h3>
    <form id="rental-form" >
        <input type="hidden" name="vehicle_id" id="vehicle_id" value="">

        <label for="start">Pick-up Date:</label>
        <input type="text" id="start" name="start" placeholder="Select pick-up date" required>

        <label for="end">Drop-off Date:</label>
        <input type="text" id="end" name="end" placeholder="Select drop-off date" required>

        <label for="method">Payment Method:</label>
        <select id="method" name="method" required>
            <option value="" disabled selected>Select payment method</option>
            <option value="Electronic">Electronic</option>
            <option value="Cash">Cash</option>
        </select>
        <button type="submit" class="book-btn">Book Now</button>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let vehicle = {};
const userId = <?php echo json_encode($userId); ?>;
const userName = <?php echo json_encode($name); ?>;
    
document.getElementById('rental-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    // Get the current user ID from PHP and vehicle data
    const userId = <?php echo json_encode($userId); ?>;
    const vehicleId = vehicle.vid;
    const vehicleMake = vehicle.make;
    const vehicleStatus = vehicle.status;
    const vehiclePrice = vehicle.price; 

    // Get form input values
    const startDate = document.getElementById('start').value;
    const endDate = document.getElementById('end').value;

    // Calculate the number of days
    const start = new Date(startDate);
    const end = new Date(endDate);

    if (isNaN(start) || isNaN(end) || end <= start) {
        alert('Please enter valid pick-up and drop-off dates.');
        return;
    }

    const timeDifference = end.getTime() - start.getTime(); // Difference in milliseconds
    const numberOfDays = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Convert to days

    // Calculate the total amount
    const totalAmount = numberOfDays * vehiclePrice;

    // Add custom data to form
    formData.append('vid', vehicleId);
    formData.append('cid', userId);
    formData.append('name', userName); 
    formData.append('payid', '');
    formData.append('vehicle', vehicleMake);
    formData.append('amount', totalAmount);

    // Check if the vehicle is unavailable
    if(userId===null || userId === "" ){
        alert('Please log in in order to continue');
        window.location.href = 'auth.html?type=Customer';
    } else {
        if(vehicleStatus === "Unavailable") {
            alert('This vehicle is currently unavailable. Please try booking a different vehicle');
            window.location.href = 'index.php'; // Redirect to home page
        } else {
            try {
                const response = await fetch('add_rental.php', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    alert('Vehicle Rented successfully');
                    window.location.href = 'index.php'; // Redirect after success
                } else {
                    alert(`Error: ${result.message}`);
                }
            } catch (error) {
                console.error('Error adding vehicle:', error);
                alert('An error occurred. Please try again.');
            }
        }
    }
    
});


        // Fetch vehicle ID from URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const vehicleId = urlParams.get('id');

        // Initialize Flatpickr date pickers
    flatpickr("#start", {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today", // Disallow past dates
        onChange: function(selectedDates, dateStr) {
            // Update the minimum date of drop-off based on pick-up date
            document.querySelector("#end")._flatpickr.set("minDate", dateStr);
        }
    });

    flatpickr("#end", {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today" // Disallow past dates
    });

    // Fetch vehicle details based on ID
    async function fetchVehicleDetails() {
            try {
                const response = await fetch(`get-vehicle-details.php?id=${vehicleId}`);
                vehicle = await response.json();

                // Update the DOM with vehicle details
                document.getElementById('vehicle-details').innerHTML = `
                <div class="vehicle-item">
                                <div >
                        <img class="vehicle-image" src="${vehicle.image}" alt="${vehicle.make}">
                    </div>
                    <div class="vehicle-info">
                        <h2>${vehicle.make}</h2>
                        <p><strong>Model:</strong> ${vehicle.model}</p>
                        <p><strong>Year:</strong> ${vehicle.year}</p>
                        <p><strong>Status:</strong> ${vehicle.status}</p>
                        <p>${vehicle.description}</p>
                        <div class="price"><strong>Price per Day: </strong> $${vehicle.price}</div>
                        <p>Read our <a href="#">TERMS AND CONDITIONS HERE.</a></p>
                    </div>
                </div>

                `;
            } catch (error) {
                console.error('Error fetching vehicle details:', error);
                document.getElementById('vehicle-details').innerHTML = `<p>Error loading details.</p>`;
        }
    }

        // Call the function to fetch vehicle details
    fetchVehicleDetails();
</script>

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

</body>
</html>
