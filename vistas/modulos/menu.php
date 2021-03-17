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
			

			?>

		</ul>

	 </section>

</aside>