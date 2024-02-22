<header>
    <nav class="navbar">
    <a href="/" class="navbar-logo">
        <img src="images/logo-2.png" alt="Logo" > 
    </a>
    <ul class="navbar-nav">
      
        <li><a href="#driver">Driver</a></li>
        <li><a href="#passenger">Passenger</a></li>
        <li><a href="/signin">Log In</a></li>
    </ul>
  </nav>
  <div class="signin-container">
    <h2>RideConnect Sign In</h2>
    <form action="/submit-your-login-form-endpoint" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="signin-btn">Sign In</button>
    </form>
    <div class="register-links">
        <a href="register-driver.html">Register as a Driver</a>
        <a href="register-passenger.html">Register as a Passenger</a>
    </div>
</div>
</header>