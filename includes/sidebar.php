<div class="sidebar-overlay">
      <aside class="sidebar">
        <!-- close -->
        <button class="sidebar-close">
          <i class="fas fa-times"></i>
        </button>
        <!-- links -->
        <ul class="sidebar-links">
          <li>
            <a href="index.html" class="sidebar-link">
              <i class="fas fa-home fa-fw"></i>
              home
            </a>
          </li>
          <li>
            <a href="products.html" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              products
            </a>
          </li>
          <li>
            <a href="about.html" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              about
            </a>
          </li>
          <?php
          global $loggedin;
          if (!$loggedin) {
              echo '<li>
            <a href="register.php" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              Register
            </a>
          </li>
          <li>
            <a href="login.php" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              Login
            </a>
          </li>';
          }
          else{
              echo'<li>
            <a href="logout.php" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              logout
            </a>
          </li>
          <li>
            <a href="orderHistory.php" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              order history
            </a>
          </li>';
          }
          ?>
        </ul>
      </aside>
    </div>