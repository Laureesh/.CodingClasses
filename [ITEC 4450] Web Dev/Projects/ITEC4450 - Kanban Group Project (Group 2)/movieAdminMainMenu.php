<!-- MovieFlix Admin Menu for Movies -->
<div class="w3-container w3-black">
    <div class="w3-bar w3-theme-d5">
        <!-- MovieFlix Home -->
        <a href="index.php" class="w3-bar-item w3-button w3-hover-cyan">
            <strong>Back To MovieFlix Home Page</strong>
        </a>
        <!-- MovieFlix Manage Actors -->
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button w3-hover-cyan">Manage Actors</button>
            <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                <a href="newActor.php" class="w3-bar-item w3-button">New Actor</a>
                <a href="editActor.php" class="w3-bar-item w3-button">Edit Actor</a>
                <a href="showActors.php" class="w3-bar-item w3-button">View All Actors</a>
                <a href="deleteActor.php" class="w3-bar-item w3-button">Delete Actor</a>
                <a href="assignActor.php" class="w3-bar-item w3-button">Assign Actor to Movie</a>
                <a href="unassignActor.php" class="w3-bar-item w3-button">Unassign Actor from Movie</a>
            </div>
        </div>
        <!-- MovieFlix Manage Movies -->
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button w3-hover-cyan">Manage Movies</button>
            <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                <a href="newMovie.php" class="w3-bar-item w3-button">New Movie</a>
                <a href="editMovie.php" class="w3-bar-item w3-button">Edit Movie</a>
                <a href="showMovies.php" class="w3-bar-item w3-button">View All Movies</a>
                <a href="deleteMovie.php" class="w3-bar-item w3-button">Delete Movie</a>
            </div>
        </div>
        <!-- MovieFlix Manage Genres -->
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button w3-hover-cyan">Manage Genres</button>
            <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                <a href="newGenre.php" class="w3-bar-item w3-button">New Genre</a>
                <a href="editGenre.php" class="w3-bar-item w3-button">Edit Genre</a>
                <a href="showGenres.php" class="w3-bar-item w3-button">View All Genres</a>
                <a href="deleteGenre.php" class="w3-bar-item w3-button">Delete Genre</a>
            </div>
        </div>
        <!-- MovieFlix Manage Admin Home -->
        <a href="adminMovies.php" class="w3-bar-item w3-button w3-hover-cyan w3-right">Movie Admin Home Page</a>
    </div>
</div>