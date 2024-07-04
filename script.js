document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const bookmarksList = document.getElementById("bookmarksList");

    // Add click event listener to search input
    searchInput.addEventListener("click", function() {
        // Clear bookmarks list
        bookmarksList.innerHTML = "";

        // Get Chrome bookmarks
        chrome.bookmarks.search("", function(bookmarks) {
            displayBookmarks(bookmarks);
        });
    });

    function displayBookmarks(bookmarks) {
        bookmarks.forEach(function(bookmark) {
            const li = document.createElement("li");
            li.textContent = bookmark.title;
            li.setAttribute("data-url", bookmark.url); // Store the URL as a data attribute
            li.addEventListener("click", function() {
                // Remove selected class from all bookmarks
                bookmarksList.querySelectorAll("li").forEach(function(item) {
                    item.classList.remove("selected");
                });
                // Add selected class to the clicked bookmark
                li.classList.add("selected");
            });
            bookmarksList.appendChild(li);
        });
    }
});
