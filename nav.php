<nav>
    <ol>
        <?php
        if ($path_parts['filename'] == "home") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="home.php">Home</a></li>';
        }
        if ($path_parts['filename'] == "form") {
            print '<li class="activePage">Register</li>';
        } else {
            print '<li><a href="form.php">Register</a></li>';
        }
        ?>
    </ol>
</nav>
