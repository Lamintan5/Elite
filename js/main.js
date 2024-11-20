
(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
})(jQuery);

// Fetch vehicle data and display in grid
async function fetchVehicles() {
    try {
        const response = await fetch('fetch_vehicles.php');
        const vehicles = await response.json();

        const grid = document.querySelector('.vehicles-grid');
        grid.innerHTML = ''; // Clear previous content

        // Limit the number of vehicles to 10
        const vehiclesToDisplay = vehicles.slice(0, 40);

        vehiclesToDisplay.forEach(vehicle => {
            const card = document.createElement('div');
            card.classList.add('vehicle-card');
            card.setAttribute('onclick', `navigateToDetails(${vehicle.vid})`);

            card.innerHTML = `
                <img src="${vehicle.image}" alt="${vehicle.make} ${vehicle.model}">
                <div class="cnt">
                    <h3>${vehicle.make} ${vehicle.model}</h3>
                    <p>Year: ${vehicle.year}</p>
                    <p class="price">$${vehicle.price} per day</p>
                    <p class="status ${vehicle.status.toLowerCase()}">${vehicle.status}</p>
                </div>
            `;

            grid.appendChild(card);
        });
    } catch (error) {
        console.error('Error fetching vehicle data:', error);
    }
}


// Call the function to load vehicle data on page load
window.onload = fetchVehicles;

function navigateToDetails(vehicleId) {
    // Redirect to vehicle details page with the vehicle ID as a query parameter
    window.location.href = `vehicle-details.php?id=${vehicleId}`;
}

window.addEventListener('scroll', reveal);
        function reveal(){
        var reveals = document.querySelectorAll('.reveal');
        for(var i = 0; i < reveals.length; i++){
            var windowheight = window.innerHeight;
            var revealtop = reveals[i].getBoundingClientRect().top;
            var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active');
        } else {
            reveals[i].classList.remove('active');
        }
    }
}

