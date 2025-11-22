<?php
    function htc($text) {
        return htmlspecialchars($text);
    }

    // Extract YouTube ID from full URL
    function extractYouTubeID($url) {
        if (preg_match('/v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
?>
<script>
function playMovie(movieId) {
    window.location.href = 'watchMovie.php?id=' + movieId;
}

function searchMovies() {
    var searchTerm = document.getElementById('searchInput').value;
    if(searchTerm.trim() !== '') {
        window.location.href = 'search.php?q=' + encodeURIComponent(searchTerm);
    }
}

function addToWatchlist(movieId) {
    window.location.href = 'addToWatchlist.php?movie_id=' + movieId;
}

function removeFromWatchlist(movieId) {
    window.location.href = 'removeFromWatchlist.php?movie_id=' + movieId;
}
</script>