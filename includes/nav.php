
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
                      <a class="nav-link" href="/bay-realty/wishlist"><i class="fa fa-heart fa-lg"></i></a>
                    </li>
                          
               <li class="nav-item">
                    <div class="welcome ml-auto"><?php if (isset($_SESSION['guestUserName'])) { echo "<a class='nav-link no-dropdown' href='processes/process-logout'><i class='fa fa-sign-out fa-2x fa-fw'></i><span class='d-none d-md-inline'> Logout</span></a>"; }; ?></div>
                  </li>
                      <li class="nav-item">
                    
                  </li>
                  <li class="nav-item">
                    <div class="welcome ml-auto"><?php if (isset($_SESSION['guestUserName'])) { echo "<p>" . $_SESSION['guestUserName'] . "</p>"; }; ?></div>
                  </li>
                  </ul>
                </div>
            </div>
          </nav>
