<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <a href="#" class="nav-link active" data-section="vehicles">Vehicles</a>
            <a href="#" class="nav-link" data-section="rentals">Rentals</a>
            <a href="#" class="nav-link" data-section="payments">Payments</a>
        </div>
        
        <div class="user-profile">
            <i class="fa-regular fa-user profile-icon"></i>
            <div class="user-column">
                
            <?php   
          
                $isLoggedIn = isset($_SESSION['user']);

                if ($isLoggedIn) {
                    $user = $_SESSION['user'];
                    echo "<h4>" . htmlspecialchars($user['name']) . "</h4>";
                } else {
                    echo "<p>You are not logged in.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Vehicles Section -->
        <section id="vehicles" class="content-section">
        <div class="row"> 
            <h2>Vehicles</h2>
            <div class="add-button" onclick="openModal()">Add</div>
        </div>
        <table id="vehicles-table">
            <thead>
                <tr>
                    <th>Vehicle ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Price/Day</th>
                    
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>



        <!-- Rentals Section -->
        <section id="rentals" class="content-section" style="display: none;">
            <h2>Rentals</h2>
            <table id="rentals-table">
                <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>

        <!-- Payments Section -->
        <section id="payments" class="content-section" style="display: none;">
            <h2>Payments</h2>
            <table id="payments-table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
    </div>

    <!-- Modal for Adding Vehicle -->
    <div id="addVehicleModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Add Vehicle</h3>
            <form id="addVehicleForm">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                
                <label for="make">Make:</label>
                <input type="text" id="make" name="make" placeholder="Enter vehicle make" required>
                
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" placeholder="Enter vehicle model" required>
                
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" placeholder="Enter manufacture year" required>
                
                <label for="price">Price Per Day:</label>
                <input type="number" id="price" name="price" placeholder="Enter price per day" required>
                
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="js/api.js"></script>   
    <script>
        // JavaScript to handle navigation
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');

        navLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();

                // Remove active class from all links
                navLinks.forEach(link => link.classList.remove('active'));

                // Hide all sections
                sections.forEach(section => section.style.display = 'none');

                // Add active class to clicked link
                link.classList.add('active');

                // Show the selected section
                const sectionId = link.getAttribute('data-section');
                document.getElementById(sectionId).style.display = 'block';
            });
        });
    </script>
    
</body>
</html>
