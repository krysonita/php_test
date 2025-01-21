document.addEventListener("DOMContentLoaded", () => {
    const searchBar = document.querySelector("#search_bar");

    console.log("Search bar element:", searchBar); // Debugging

    if (searchBar) {
        searchBar.onkeyup = () => {
            let searchTerm = searchBar.value.trim();
            console.log("Search Term:", searchTerm);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/myshop/search.php", true);

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log("Response from Server:", xhr.response); // Log server response
                        document.querySelector("#tbody").innerHTML = xhr.response; // Update table body
                    } else {
                        console.error("Error: Server returned status", xhr.status);
                    }
                }
            };

            xhr.onerror = () => {
                console.error("Error: AJAX request failed.");
            };

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("searchTerm=" + encodeURIComponent(searchTerm)); // Send search term
        };
    } else {
        console.error("Error: #search_bar element not found in the DOM.");
    }
});
