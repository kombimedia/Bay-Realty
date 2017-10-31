<nav class="navbar navbar-expand-md fixed-top">
  <div class="container">

      <a class="navbar-brand" href="/bay-realty"><img src="images/bay-realty-logo.png"></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-main" aria-controls="navbars-main" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
      </button>


      <div class="collapse navbar-collapse" id="navbars-main">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/bay-realty">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/bay-realty/about-us">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/bay-realty/contact-us">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/bay-realty/wishlist.php#my_wishlist"><i class="fa fa-heart fa-lg"></i></a>
            </li>
            <li class="nav-item">
              <div class="pl-5"><?php if (isset($_SESSION['guestUserName'])) { echo "<a class='nav-link no-dropdown' href='processes/process-logout'><span class='d-none d-md-inline'> Log out</span></a>"; }; ?>
              </div>
            </li>
            <li class="nav-item">
            </li>
            <!-- <li class="nav-item">
              <div class="welcome ml-auto"><?php if (isset($_SESSION['guestUserName'])) { echo "<span>" . $_SESSION['guestUserName'] . "</span>"; }; ?></div>
            </li> -->
        </ul>
        <div class="welcome pl-2"><?php if (isset($_SESSION['guestUserName'])) { echo "<span>" . $_SESSION['guestUserName'] . "</span>"; }; ?></div>
      </div>
  </div>
</nav>

