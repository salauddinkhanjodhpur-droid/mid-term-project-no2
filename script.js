// script.js
document.addEventListener("DOMContentLoaded", function () {
    // ===== Delete Confirmation =====
    const deleteLinks = document.querySelectorAll(".btn-delete");

    deleteLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // normal navigation rok do

            const confirmed = window.confirm(
                "Are you sure you want to delete this task?"
            );

            if (confirmed) {
                // agar user ne OK dabaya
                window.location.href = this.getAttribute("href");
            }
        });
    });

    // ===== Status Color Classes =====
    const statusCells = document.querySelectorAll(".status-cell");

    statusCells.forEach((cell) => {
        const value = cell.textContent.trim().toLowerCase();

        if (value === "pending") {
            cell.classList.add("status-pending");
        } else if (value === "completed") {
            cell.classList.add("status-completed");
        }
    });
});
