<?php
include 'processes/process-populate-footer-our-team.php';
?>
      <footer>
        <div class="container-fluid footer-widget-area">
          <div class="container">
            <div class="row">
                  <div class="col-12 col-xl-4 footer-widget">
                    <div class="footer-widget-content">
                      <h3>About Us</h3>
                      <p>With three offices situated in Tauranga, Mt Maunganui and Papamoa we have specialised sales consultants covering residential, lifestyle, sections and apartment sales throughout the Bay of Plenty.</p>
                      <a href="/bay-realty/about-us">Read more...</a>
                    </div>
                  </div>
                  <div class="col-12 col-xl-4 footer-widget">
                    <div class="footer-widget-content">
                      <h3>Our Team</h3>
                          <table class="table table-sm table-responsive our-team">
                              <?php echo $populate_our_team ?>
                          </table>
                    </div>
                  </div>
                  <div class="col-12 col-xl-4 footer-widget">
                    <div class="footer-widget-content">
                      <h3>Contact Us</h3>
                      <ul class="property-press">
                          <li><b>Bay Realty Ltd</b></li>
                          <li>Head Office</li>
                          <li>1 Third Avenue</li>
                          <li>PO Box 885, Tauranga 3110</li>
                          <li>07 578 0879</li>
                          <li><a href="mailto:info@bayrealty.co.nz">info@bayrealty.co.nz</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- <div class="col-md-6 col-xl-3 footer-widget">
                    <div class="col footer-widget-content">
                      <h3>Receive Our Newsletter</h3>
                      <form class="form-signin" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="newsletterName" class="sr-only">Email address</label>
                        <input type="text" id="newsletterName" name="nlName" class="form-control mb-2" placeholder="Full name" required autofocus>
                        <label for="newsletterEmail" class="sr-only">Password</label>
                        <input type="email" id="newsletterEmail" name="nlEmail" class="form-control mb-3" placeholder="Your email" required>
                        <button class="btn btn-md btn-block" type="submit">Sign Up</button>
                      </form>
                    </div>
                  </div> -->
            </div>
          </div>
        </div>

        <div class="container-fluid footer">
          <div class="container">
            <div class="row">
                  <span class="copyrite">Bay Realty Ltd <i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date("Y"); ?></span>
            </div>
          </div>
        </div>
      </footer>

    <!-- Call in Javascript files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/custom.js"></script>
  </body>
</html>

<?php
$mysqli->close();
?>




<!-- <div class="row">
                  <div class="col-md-6 col-xl-3 footer-widget">
                    <div class="col footer-widget-content">
                      <h3>About Us</h3>
                      <p>With three offices situated in Tauranga, Mt Maunganui and Papamoa we have specialised sales consultants covering residential, lifestyle, sections and apartment sales throughout the Bay of Plenty.</p>
                      <a href="/bay-realty/about-us">Read more...</a>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-3 footer-widget">
                    <div class="col footer-widget-content">
                      <h3>Our Team</h3>
                          <table class="table table-sm table-responsive our-team">
                              <?php echo $populate_our_team ?>
                          </table>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-3 footer-widget">
                    <div class="col footer-widget-content">
                      <h3>Property Press</h3>
                      <ul class="property-press">
                          <li>July 2017 <a href="#">download</a></li>
                          <li>Aug 2017 <a href="#">download</a></li>
                          <li>Sept 2017 <a href="#">download</a></li>
                          <li>Oct 2017 <a href="#">download</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-3 footer-widget">
                    <div class="col footer-widget-content">
                      <h3>Receive Our Newsletter</h3>
                      <form class="form-signin" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="newsletterName" class="sr-only">Email address</label>
                        <input type="text" id="newsletterName" name="nlName" class="form-control mb-2" placeholder="Full name" required autofocus>
                        <label for="newsletterEmail" class="sr-only">Password</label>
                        <input type="email" id="newsletterEmail" name="nlEmail" class="form-control mb-3" placeholder="Your email" required>
                        <button class="btn btn-md btn-block" type="submit">Sign Up</button>
                      </form>
                    </div>
                  </div>
            </div>
          </div> -->
