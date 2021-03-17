<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
			
			<!-- inicio -->
			<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<!--=====================================
			=            ADMINISTRADOR            =
			======================================-->
			<?php 

			if($_SESSION['perfil']=="Administrador"){
		
				
			}

			?>
			
			<!--=====================================
			=            VENDEDOR            =
			======================================-->

			<?php 
			
			if($_SESSION['perfil']=="Vendedor"){
			
			
			}
			
			
			if($_SESSION['perfil']=="Tecnico"){
			
				include('menu/tecnico.php');
			}
			
			?>
			<!--=====================================
			=            ADMINISTRATIVO            =
			======================================-->

			<?php 

			if($_SESSION['perfil']=="Administrativo"||$_SESSION['perfil']=="Vendedor"){

				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-area-chart"></i>
					
					<span>Reportes</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					
					<li>

						<a href="reportes">
							
							<i class="fa fa-pie-chart"></i>
							<span>Reportes</span>

						</a>

					</li>

					<li>

						<a href="ventas-repuestos">
							
							<i class="fa fa-bar-chart"></i>
							<span>Ver Ventas</span>

						</a>

					</li>

					<li>

						<a href="ventas-cobradas">
							
							<i class="fa fa-line-chart"></i>
							<span>Ver Cobranzas</span>

						</a>

					</li>

					<li>

						<a href="buscar-venta-cliente">
							
							<i class="fa fa-user-circle"></i>
							<span>Ver Compras Cliente</span>

						</a>

					</li>

					<li>

						<a href="buscar-venta-repuestos">
							
							<i class="fa fa-dropbox"></i>
							<span>Ver Ventas Articulo</span>

						</a>

					</li>

				</ul>

			</li>';

			}

			?>
			
			<?php 

			if($_SESSION['perfil']=="Vendedor"||$_SESSION['perfil']=="Tecnico"){

			echo '<li>

					<a href="buscar-venta-nro">
								
						<i class="fa fa-search"></i>
						<span>Buscar</span>

					</a>

				</li>

				<li>

					<a href="remitos">
								
						<i class="fa fa-bookmark"></i>
						<span>Remitos</span>

					</a>

				</li>

			<li>

							<a href="gastos">
								
								<i class="fa fa-sticky-note"></i>
								<span>Gastos</span>

							</a>

						</li>';
			}

			?>

		</ul>

	 </section>

</aside>