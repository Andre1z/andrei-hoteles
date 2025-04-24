// Función para guardar valores en local storage
function saveToLocalStorage() {
    const roomNumber = document.getElementById("room_number").value;
    const roomType = document.getElementById("room_type").value;
    const price = document.getElementById("price").value;
    const description = document.getElementById("description").value;
    const availability = document.querySelector('input[name="availability"]:checked').value;

    localStorage.setItem("room_number", roomNumber);
    localStorage.setItem("room_type", roomType);
    localStorage.setItem("price", price);
    localStorage.setItem("description", description);
    localStorage.setItem("availability", availability);
}

// Función para cargar valores desde local storage
function loadFromLocalStorage() {
    if (localStorage.getItem("room_number")) {
        document.getElementById("room_number").value = localStorage.getItem("room_number");
    }
    if (localStorage.getItem("room_type")) {
        document.getElementById("room_type").value = localStorage.getItem("room_type");
    }
    if (localStorage.getItem("price")) {
        document.getElementById("price").value = localStorage.getItem("price");
    }
    if (localStorage.getItem("description")) {
        document.getElementById("description").value = localStorage.getItem("description");
    }
    if (localStorage.getItem("availability")) {
        const availability = localStorage.getItem("availability");
        document.getElementById(availability === "1" ? "available_yes" : "available_no").checked = true;
    }
}

// Función para limpiar el local storage
function clearLocalStorage() {
    localStorage.removeItem("room_number");
    localStorage.removeItem("room_type");
    localStorage.removeItem("price");
    localStorage.removeItem("description");
    localStorage.removeItem("availability");
}

// Cargar los valores cuando la página se carga
document.addEventListener("DOMContentLoaded", loadFromLocalStorage);