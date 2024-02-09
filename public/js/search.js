document.getElementById("name").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.getElementById("search_form").submit();
        }
    });
