// Fetch data from the API and populate the table
async function fetchData(section) {
    let url;
    switch (section) {
        case 'vehicles':
            url = 'vehicles.php';
            break;
        case 'rentals':
            url = 'rentals.php';
            break;
        case 'payments':
            url = 'payments.php';
            break;
        default:
            return;
    }

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.success) {
            populateTable(section, data.data);
        } else {
            console.error(data.message);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Populate the table with data
function populateTable(section, data) {
    const table = document.querySelector(`#${section}-table tbody`);
    table.innerHTML = ''; // Clear existing rows

    data.forEach(item => {
        const row = document.createElement('tr');
        Object.values(item).forEach(value => {
            const cell = document.createElement('td');
            cell.textContent = value;
            row.appendChild(cell);
        });
        table.appendChild(row);
    });
}

// Navigation logic
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

        // Fetch and display data for the section
        fetchData(sectionId);
    });
});

// Fetch data for the default section (Vehicles) on page load
fetchData('vehicles');
// Open the modal
function openModal() {
    document.getElementById('addVehicleModal').style.display = 'flex';
}

// Close the modal
function closeModal() {
    document.getElementById('addVehicleModal').style.display = 'none';
}

// Handle form submission
document.getElementById('addVehicleForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('add_vehicle.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            alert('Vehicle added successfully');
            closeModal();
            // Optionally, refresh the vehicle table
            fetchData('vehicles');
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error('Error adding vehicle:', error);
        alert('An error occurred. Please try again.');
    }
});

