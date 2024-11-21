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

function populateTable(section, data) {
    const table = document.querySelector(`#${section}-table tbody`);
    table.innerHTML = ''; 

    data.forEach(item => {
        const row = document.createElement('tr');
         
         row.setAttribute('onclick', 'showRentalDetails(this)');

         if (item.id) {
             row.dataset.rentalId = item.id; 
         }
        Object.values(item).forEach(value => {
            const cell = document.createElement('td');
            cell.textContent = value;
            row.appendChild(cell);
        });
        table.appendChild(row);
    });
}

const navLinks = document.querySelectorAll('.nav-link');
const sections = document.querySelectorAll('.content-section');

navLinks.forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();
        navLinks.forEach(link => link.classList.remove('active'));
        sections.forEach(section => section.style.display = 'none');
        link.classList.add('active');
        const sectionId = link.getAttribute('data-section');
        document.getElementById(sectionId).style.display = 'block';
        fetchData(sectionId);
    });
});

fetchData('vehicles');
function openModal() {
    document.getElementById('addVehicleModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('addVehicleModal').style.display = 'none';
}

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
            fetchData('vehicles');
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error('Error adding vehicle:', error);
        alert('An error occurred. Please try again.');
    }
});

