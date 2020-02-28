<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- <li class="header">{{ trans('adminlte_lang::message.header') }}</li> -->
            <!-- Optionally, you can add icons to the links -->
                <li><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span> @if(Auth::user()->hasRole('Administrador')) Servicios Ejecutados @else Inicio @endif</span></a></li>
            @if (Auth::user()->hasRole('SuperAdmin'))    
                <li><a href="{{ url ('empresa') }}"><i class='fa fa-bank'></i> <span>Empresas</span></a></li>
                <li><a href="{{ url ('user') }}"><i class='fa fa-users'></i> <span>Usuarios</span></a></li>
            @endif
            
            @if (Auth::user()->hasRole('Administrador'))    
                <li><a href="{{ url('ciudad') }}"><i class='fa fa-map-marker'></i> <span>Ciudades</span></a></li>
                <li><a href="{{ url('inscripcion') }}"><i class='fa fa-bank'></i> <span>Consultar Inscripción</span></a></li>
                <li><a href="{{ url('indexPersona') }}"><i class='fa fa-users'></i> <span>Agregar Profesional </span></a></li>
                <li><a href="{{ url('orden') }}"><i class='fa fa-briefcase'></i> <span>Ordenes de servicio</span></a></li>
                <li class="treeview">
                    <a href=""><i class='fa fa-star-half-o'></i> <span>Calificaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    <li><a href="{{ url('calificacliente') }}">Clientes</a></li>
                    <li><a href="{{ url('calificaprof') }}">Profesionales</a></li>
                   </ul>
                </li>

            @endif
            
            @if (Auth::user()->hasRole('Profesional'))
                <li><a href="{{ url('ordenP') }}"><i class='fa fa-briefcase'></i> <span>Ordenes de Servicio</span></a></li>
                <li><a href="{{ url('vercalificacion') }}"><i class='fa fa-thumbs-o-up'></i> <span>Calificaciones</span></a></li>
                <li><a href="{{ url('historial') }}"><i class='fa fa-calendar'></i> <span>Historial de Ordenes</span></a></li>

  <!-- Link para visualizar ordenes sin pagar desactivado     -->          
                <!-- <li><a href="{{ url('ordenesSinPagar') }}"><i class='fa fa-money'></i> <span>Ordenes sin pagar</span></a></li> -->
                <!-- <li><a href="#"><i class='fa fa-history'></i> <span>Historial de ordenes</span></a></li> -->
            @endif

            @if (Auth::user()->hasRole('Cliente'))
                <li><a href="{{ url('ordenC') }}"><i class='fa fa-briefcase'></i> <span>Ordenes de Servicio</span></a></li>
                <li><a href="{{ url('vercalificacionCliente') }}"><i class='fa fa-thumbs-o-up'></i> <span>Calificaciones</span></a></li>
                <!-- <li><a href="{{ url('historialCliente') }}"><i class='fa fa-calendar'></i> <span>Historial de Ordenes</span></a></li> -->

  <!-- Link para visualizar ordenes sin pagar desactivado     -->          
                <!-- <li><a href="{{ url('ordenesSinPagar') }}"><i class='fa fa-money'></i> <span>Ordenes sin pagar</span></a></li> -->
                <!-- <li><a href="#"><i class='fa fa-history'></i> <span>Historial de ordenes</span></a></li> -->
            @endif
            
            <!-- <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"> * * * </a></li>
                    <li><a href="#"> * * * </a></li>
                </ul>
            </li> -->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
