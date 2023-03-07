     <!-- <br><br>
       Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) --> 
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar  -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a title="<?=$_SESSION['cargo']?>" class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'];?></span>
                <?php if($_SESSION['genero'] == "M"){?>
                <img class="img-profile rounded-circle" src="public/images/avatar_hombre.jpg">
                <?php }else{ ?>
                <img class="img-profile rounded-circle" src="public/images/avatar_mujer.png">
                <?php } ?>
              </a>
              <?php if ( $_SESSION['cargo'] == 'ADMINISTRADOR' || $_SESSION['cargo'] == 'GERENTE' || $_SESSION['cargo'] == 'CLIENTE' ) {?>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <!-- <a class="dropdown-item" href="?view=usuarios&mode=changepass">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cambio de contraseña
                  </a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Desconectar
                  </a>
                </div><!---->
              <?php }?>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->


