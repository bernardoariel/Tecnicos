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
		
				echo '<li>

						<a href="usuarios">

							<i class="fa fa-user"></i>
							<span>Usuarios</span>

						</a>

					  </li>

					  <li>

						<a href="registros">

							<i class="fa fa-file-text-o"></i>
							<span>Registros</span>

						</a>

					  </li>

			
						<li>

							<a href="miempresa">

								<i class="fa fa-university"></i>
								<span>Empresa</span>

							</a>

						</li>';
			}

			?>
			
			<!--=====================================
			=            VENDEDOR            =
			======================================-->

			<?php 
			
			if($_SESSION['perfil']=="Vendedor"){
			
			echo '
			<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>

		    
			<li>

				<a href="losmodelos">

					<i class="fa fa-list-ol"></i>
					<span>Modelos</span>

				</a>

			</li>
			
			
			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>


			
			<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>';
			
			
			
				echo '<li class="treeview">

					<a href="#">

						<i class="fa fa-list-ul"></i>
						
						<span>Ventas</span>
						
						<span class="pull-right-container">
						
							<i class="fa fa-angle-left pull-right"></i>

						</span>

					</a>

					<ul class="treeview-menu">
						
						<li>

							<a href="ventas">
								
								<i class="fa fa-table"></i>
								<span>Administrar ventas</span>

							</a>

						</li>

						<li>

							<a href="crear-venta">
								
								<i class="fa fa-file"></i>
								<span>Crear venta</span>

							</a>

						</li>

						<li>

							<a href="etiquetas">
								
								<i class="fa fa-sticky-note"></i>
								<span>Etiquetas</span>

							</a>

						</li>

						<li>

							<a href="ctacorriente">
								
								<i class="fa fa-spinner"></i>
								<span>Cta Corriente</span>

							</a>

						</li>

					</ul>

				</li>
					';
			}
			
			

			
			
			if($_SESSION['perfil']=="Tecnico"){
			
			
			
			
				echo '<li class="treeview">

					<a href="#">

						<i class="fa fa-list-ul"></i>
						
						<span>Ventas</span>
						
						<span class="pull-right-container">
						
							<i class="fa fa-angle-left pull-right"></i>

						</span>

					</a>

					<ul class="treeview-menu">
						
						<li>

							<a href="ventas">
								
								<i class="fa fa-table"></i>
								<span>Administrar ventas</span>

							</a>

						</li>
<li>

							<a href="ctacorriente">
								
								<i class="fa fa-spinner"></i>
								<span>Cta Corriente</span>

							</a>

						</li>

						<li>

							<a href="crear-venta">
								
								<i class="fa fa-file"></i>
								<span>Crear venta</span>

							</a>

						</li>

						<li>

							<a href="etiquetas">
								
								<i class="fa fa-sticky-note"></i>
								<span>Etiquetas</span>

							</a>

						</li>

						

					</ul>

				</li>
					';
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