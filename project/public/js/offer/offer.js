function toggleStatus(offerId) {
    fetch(`/offers/toggle-status/${offerId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        let statusSpan = document.getElementById(`status-${offerId}`);
        statusSpan.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
        statusSpan.className = `badge bg-${data.status === 'active' ? 'success' : 'secondary'} cursor-pointer`;
    })
    .catch(error => console.error("Error:", error));
}