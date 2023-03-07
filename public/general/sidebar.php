<!--  --->
<body id="page-top">

  <!-- Page Wrapper --->
  <div id="wrapper"> 

    <!-- Sidebar --->
  <?php 
  if ( $_SESSION['estatusClave'] != 0 ) {
     /* if($_SESSION['cargo'] == 'OPERADOR'){

      }else */if($_SESSION['cargo'] == 'CLIENTE'){ ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseReportes">
              <i class="fas fa-fw fa-user"></i>
              <span>Reportes</span>
            </a>
            <div id="collapseReportes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=reportes&mode=conectado_time_real">Gestión en vivo</a>
                <a class="collapse-item" href="?view=reportes&mode=conexionxagente">Conexión por agente</a>
                <a class="collapse-item" href="?view=reportes&mode=auxiliar">Auxiliares</a>            
                <a class="collapse-item" href="?view=usuarios&mode=HistorySesionAgente">Histórico de sesión</a>
              </div>
            </div>
          </li>
        </ul>
      <?php  
      }else if($_SESSION['cargo'] == 'SUPERVISOR' /* OR $_SESSION['cargo'] == 'ANALISTA'*/ ){ ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
          <!-- Sidebar - Brand --->
          <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light">
            <div class="sidebar-brand-icon">
            <img width="75%" src="public/images/logo_prc.png" alt="">
            </div>
          </a>
          <!-- Divider --->
          <hr class="sidebar-divider my-0">
          <!-- Divider -->
          <hr class="sidebar-divider">
          <!-- Heading 
          <div class="sidebar-heading">
            Configuración
          </div>-->

          <!-- Nav Item - Pages Collapse Menu-->
          <li class="nav-item">
            <a target="_blank" class="nav-link" href="?view=contador&mode=index">
              <i class="fas fa-fw fa-table"></i>
              <span>Contador</span></a>
          </li> 

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-user"></i>
              <span>Usuarios</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=usuarios&mode=index">Usuarios registrados</a>
                <a class="collapse-item" href="?view=usuarios&mode=new_individual">Carga individual</a><!---->
                <a class="collapse-item" href="?view=usuarios&mode=new_masivo">Carga masiva</a>
                <a class="collapse-item" href="?view=usuarios&mode=indexEgresado">Histórico de egresados</a>
              </div>
            </div>
          </li>
          <!-- Divider -->
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseReportes">
              <i class="fas fa-fw fa-user"></i>
              <span>Reportes</span>
            </a>
            <div id="collapseReportes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=reportes&mode=conectado_time_real">Gestión en vivo</a>
                <a class="collapse-item" href="?view=reportes&mode=conexionxagente">Conexión por agente</a>
                <a class="collapse-item" href="?view=reportes&mode=auxiliar">Auxiliares</a>            
                <a class="collapse-item" href="?view=usuarios&mode=HistorySesionAgente">Histórico de sesión</a>
                <!--<a class="collapse-item" href="?view=reportes&mode=detalladoxdia">Rango</a>-->
              </div>
            </div>
          </li> 

          <!-- Divider 
          <hr class="sidebar-divider">-->
     

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

        </ul>
      <?php 
      }else if( $_SESSION['cargo'] == 'COORDINADOR'  OR $_SESSION['cargo'] == 'GERENTE'){ ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
          <!-- Sidebar - Brand --->
          <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light">
            <div class="sidebar-brand-icon">
            <img width="75%" src="public/images/logo_prc.png" alt="">
            </div>
          </a>
          
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig" aria-expanded="true" aria-controls="collapseConfig">
              <i class="fas fa-fw fa-user"></i>
              <span>Configuración</span>
            </a>
            <div id="collapseConfig" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=config&mode=posicion_mes">Posiciones mes</a>
              </div>
            </div>
          </li>
          <hr class="sidebar-divider">
         <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgregar" aria-expanded="true" aria-controls="collapseAgregar">
              <i class="fas fa-fw fa-user"></i>
              <span>Agregar</span>
            </a>
            <div id="collapseAgregar" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="?view=agregar&mode=index_">Servicios y campañas</a> 
              </div>
            </div>
          </li>
          <hr class="sidebar-divider">-->

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a target="_blank" class="nav-link" href="?view=contador&mode=index">
              <i class="fas fa-fw fa-table"></i>
              <span>Contador</span></a>
          </li>
          <hr class="sidebar-divider">

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-user"></i>
              <span>Usuarios</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=usuarios&mode=index">Usuarios registrados</a>
                <a class="collapse-item" href="?view=usuarios&mode=new_individual">Carga individual</a><!---->
                <a class="collapse-item" href="?view=usuarios&mode=new_masivo">Carga masiva</a>
                <a class="collapse-item" href="?view=usuarios&mode=indexEgresado">Histórico de egresados</a>
              </div>
            </div>
          </li>
          <!-- Divider -->
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseReportes">
              <i class="fas fa-fw fa-user"></i>
              <span>Reportes</span>
            </a>
            <div id="collapseReportes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=reportes&mode=conectado_time_real">Gestión en vivo</a>
                <a class="collapse-item" href="?view=reportes&mode=conexionxagente">Conexión por agente</a>
                <a class="collapse-item" href="?view=reportes&mode=auxiliar">Auxiliares</a>            
                <a class="collapse-item" href="?view=usuarios&mode=HistorySesionAgente">Histórico de sesión</a>
                <!--<a class="collapse-item" href="?view=reportes&mode=detalladoxdia">Rango</a>-->
              </div>
            </div>
          </li>

          <!-- Divider 
          <hr class="sidebar-divider">-->
     

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
        </ul>
      <?php 
    }else if($_SESSION['cargo'] == 'ADMINISTRADOR'){ ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
          <!-- Sidebar - Brand --->
          <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light">
            <div class="sidebar-brand-icon">
            <img width="75%" src="public/images/logo_prc.png" alt="">
            </div>
          </a>
          
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig" aria-expanded="true" aria-controls="collapseConfig">
              <i class="fas fa-fw fa-user"></i>
              <span>Configuración</span>
            </a>
            <div id="collapseConfig" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=config&mode=posicion_mes">Posiciones mes</a>
              </div>
            </div>
          </li>
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgregar" aria-expanded="true" aria-controls="collapseAgregar">
              <i class="fas fa-fw fa-user"></i>
              <span>Agregar</span>
            </a>
            <div id="collapseAgregar" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="?view=agregar&mode=index_">Servicios y campañas</a><!-- -->
              </div>
            </div>
          </li>
          <hr class="sidebar-divider">

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a target="_blank" class="nav-link" href="?view=contador&mode=index">
              <i class="fas fa-fw fa-table"></i>
              <span>Contador</span></a>
          </li>
          <hr class="sidebar-divider">

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-user"></i>
              <span>Usuarios</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=usuarios&mode=index">Usuarios registrados</a>
                <a class="collapse-item" href="?view=usuarios&mode=new_individual">Carga individual</a>
                <a class="collapse-item" href="?view=usuarios&mode=new_masivo">Carga masiva</a>
                <a class="collapse-item" href="?view=usuarios&mode=indexEgresado">Histórico de egresados</a>
              </div>
            </div>
          </li>
          <!-- Divider -->
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseReportes">
              <i class="fas fa-fw fa-user"></i>
              <span>Reportes</span>
            </a>
            <div id="collapseReportes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="?view=reportes&mode=conectado_time_real">Gestión en vivo</a>
                <a class="collapse-item" href="?view=reportes&mode=conexionxagente">Conexión por agente</a>
                <a class="collapse-item" href="?view=reportes&mode=auxiliar">Auxiliares</a>            
                <a class="collapse-item" href="?view=usuarios&mode=HistorySesionAgente">Histórico de sesión</a>
                <!--<a class="collapse-item" href="?view=reportes&mode=detalladoxdia">Rango</a>-->
              </div>
            </div>
          </li>

          <!-- Divider 
          <hr class="sidebar-divider">-->
     

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
        </ul>
      <?php 
      }else{}
  }?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

