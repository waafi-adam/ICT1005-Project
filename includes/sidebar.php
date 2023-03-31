<div class="sidebar-overlay">
      <aside class="sidebar">
        <!-- close -->
        <button class="sidebar-close" aria-label="Close Side Bar">
          <i class="fas fa-times"></i>
        </button>
        <!-- links -->
        <ul class="sidebar-links">
          <li>
            <a href="index.php" class="sidebar-link">
              <i class="fas fa-home fa-fw"></i>
              home
            </a>
          </li>
          <li>
            <a href="products.php" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              products
            </a>
          </li>
          <li>
            <a href="about.php" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              about
            </a>
          </li>
          <?php
          global $loggedin,$username;
          $adminMode=$_SESSION['adminMode'];
          if (!$loggedin) {
              echo '<li>
            <a href="register.php" class="sidebar-link">
              <i class="fas fa-user fa-fw"></i>
              Register
            </a>
          </li>
          <li>
            <a href="login.php" class="sidebar-link">
              <i class="fas fa-user fa-fw"></i>
              Login
            </a>
          </li>';
          }
          else if ($adminMode==1){
            echo '
                <li>
                    <a href="logout.php" class="sidebar-link">
                    <i class="fas fa-user fa-fw"></i>
                        Logout
                    </a>
                </li>
                <li>
                    <a href="admin.php" class="sidebar-link">
                    <i class="fas fa-user fa-fw"></i>
                        Admin
                    </a>
                </li>';
        }
        else{
             echo '
                <li>
                    <a href="logout.php" class="sidebar-link">
                    <i class="fas fa-user fa-fw"></i>
                        Logout
                    </a>
                </li>
                <li>
                    <a href="orderHistory.php" class="sidebar-link">
                    <i class="fas fa-user fa-fw"></i>
                        '.$username.'
                    </a>
                </li>';
        }
          ?>
        </ul>
      </aside>
    </div>