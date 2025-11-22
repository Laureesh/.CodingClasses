<?php
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<style>
    .w3-dropdown-hover .admin {
        right: 0; /* Pull dropdown toward the inside of the screen */
        left: auto; /* Prevent default left alignment */
    }
</style>
<div class="w3-container w3-black">
    <div class="w3-bar w3-theme-d5">
        <a href="index.php" class="w3-bar-item w3-button w3-hover-cyan">
            <img src="logo.png" style="height: 80px; width: 250px; vertical-align: middle;">
        </a>
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
            <!-- Show these menus only when logged in -->
            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button w3-hover-cyan">Admin</button>
                <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4 admin">
                    <a href="adminMovies.php" class="w3-bar-item w3-button">Manage Movies</a>
                    <a href="adminMembers.php" class="w3-bar-item w3-button">Manage Members</a>
                </div>
            </div>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button w3-hover-cyan">Movies</button>
                <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                    <a href="browseMovies.php" class="w3-bar-item w3-button">Browse All</a>
                    <a href="searchMovies.php" class="w3-bar-item w3-button">Search</a>
                    <a href="moviesByGenre.php" class="w3-bar-item w3-button">By Genre</a>
                    <a href="moviesByActor.php" class="w3-bar-item w3-button">By Actors</a>
                </div>
            </div>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button w3-hover-cyan">Reviews</button>
                <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                    <a href="addReview.php" class="w3-bar-item w3-button">Add Review</a>
                    <a href="showReviews.php" class="w3-bar-item w3-button">All Reviews</a>
                    <a href="editReview.php" class="w3-bar-item w3-button">Edit Review</a>
                    <a href="deleteReview.php" class="w3-bar-item w3-button">Delete Review</a>
                    <a href="viewReview.php" class="w3-bar-item w3-button">By Movie</a>
                </div>
            </div>

            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button w3-hover-cyan">My Account</button>
                <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4">
                    <a href="watchlist.php" class="w3-bar-item w3-button">My Watchlist</a>
                    <a href="history.php" class="w3-bar-item w3-button">Viewing History</a>
                    <a href="reset-password.php" class="w3-bar-item w3-button">Reset Password</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
                </div>
            </div>

            <span class="w3-bar-item w3-right" style="padding-top: 8px;">
                Welcome, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>
            </span>
        <?php else: ?>
            <!-- Show login/register when not logged in -->
            <a href="login.php" class="w3-bar-item w3-button w3-right w3-hover-cyan">Login</a>
            <a href="register.php" class="w3-bar-item w3-button w3-right w3-hover-cyan">Register</a>
        <?php endif; ?>
    </div>
</div>