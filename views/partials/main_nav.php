<header>
    <nav class="navbar" id="navigation">
    <a href="/" class="navbar-logo">
    <img src="images/logo-5.png" alt="Logo" > 

    </a>
    <ul class="navbar-nav">
        <li>
            <form action="/search-rides" method="get">
                <button type="submit" class="search-button">
                    <i class="fa fa-search"></i> Find
                </button>
            </form>
        </li>
      <!-- Conditionally display logout link -->
      <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'passenger' || $_SESSION['role'] === 'driver')): ?>
            <li><a href="/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
  </nav>
  
</header>