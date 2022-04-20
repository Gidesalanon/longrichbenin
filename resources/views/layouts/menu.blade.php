<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="index.html" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-list-alt nav_icon"></i>Nos Catégories <span class="nav-badge">12</span> <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('categories.index')}}">Liste des Catégories</a>
								</li>
                                <li>
									<a href="{{route('categories.create')}}">Ajouter Catégorie</a>
								</li>

                                <!-- <li>
									<a href="media.html">Modifier Catégorie</a>
								</li> -->
							</ul>
							<!-- /nav-second-level -->
						</li>
						<li class="">
							<a href="#"><i class="fa fa-book nav_icon"></i>Nos Produits <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('products.index')}}">Liste des Produits<span class="nav-badge-btm">08</span></a>
								</li>
								<li>
									<a href="{{route('products.create')}}">Ajouter Produit</a>
								</li>

							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li>
							<a href="#"><i class="fa fa-user nav_icon"></i>Nos Utilisateurs<span class="nav-badge-btm">02</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="">Liste des Utilisateurs</a>
								</li>
								<li>
									<a href="typography.html">Ajouter Utilisateur</a>
								</li>

                                <li>
									<a href="">Rôle des Utilisateurs</a>
								</li>
							</ul>
							<!-- //nav-second-level -->
						</li>

                        <li>
							<a href="{{route('users.index')}}"><i class="fa fa-check-circle nav_icon"></i>Validation Inscription <span class="nav-badge-btm">08</span></a>
						</li>
                        <li>
							<a href="{{route('admin.order.index')}}"><i class="fa fa-check-circle nav_icon"></i>Validation Commande <span class="nav-badge-btm">08</span></a>
						</li>
                        <li>
							<a href="{{route('order.approved.index')}}"><i class="fa fa-check-circle nav_icon"></i>Commande Approuvée<span class="nav-badge-btm">08</span></a>
						</li>
                        <li>
							<a href="{{route('orders.situation')}}"><i class="fa fa-check-circle nav_icon"></i>Point de Commande<span class="nav-badge-btm">08</span></a>
						</li>
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
