document.getElementById('buttonSM').addEventListener('click', function() {
    window.location.href = 'detalhamento.html'; 
});

document.getElementById('quitButton').addEventListener('click', function() {
    window.location.href = 'login.html'; 
});

const data = [
    { id: 1, title: "Filme A", releaseDate: "2023-05-20" },
    { id: 2, title: "Filme B", releaseDate: "2023-06-15" },
    { id: 3, title: "Filme C", releaseDate: "2023-07-30" }
];

// Function to populate the table with data
function populateTable() {
    const tableBody = document.querySelector("#dataTable tbody");
    tableBody.innerHTML = ""; // Clear existing rows

    data.forEach(item => {
        const row = document.createElement("tr");

        const cellId = document.createElement("td");
        cellId.textContent = item.id;
        row.appendChild(cellId);

        const cellTitle = document.createElement("td");
        cellTitle.textContent = item.title;
        row.appendChild(cellTitle);

        const cellReleaseDate = document.createElement("td");
        cellReleaseDate.textContent = item.releaseDate;
        row.appendChild(cellReleaseDate);

        tableBody.appendChild(row);
    });
}

// Call the function to populate the table on page load
document.addEventListener("DOMContentLoaded", populateTable);