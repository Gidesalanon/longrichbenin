@if (Auth::user()->is_admin == 1)
     <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="{{route('admin.home')}}" class="active"><i class="fa fa-home nav_icon"></i>Tableau de board</a>
						</li>
						<li>
							<a href="{{route('categories.index')}}"><i class="fa fa-list-alt nav_icon"></i>Catégories<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('categories.index')}}">Liste des Catégories</a>
								</li>
                                <li>
									<a href="{{route('categories.create')}}">Ajouter une Catégorie</a>
								</li>

                                <!-- <li>
									<a href="media.html">Modifier Catégorie</a>
								</li> -->
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li>
							<a href="{{route('enterprises.index')}}"><i class="fa fa-building-o nav_icon"></i>Enterprises<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('enterprises.index')}}">Liste des Entreprises</a>
								</li>
                                <li>
									<a href="{{route('enterprises.create')}}">Ajouter une Entreprise</a>
								</li>

                                <!-- <li>
									<a href="media.html">Modifier Catégorie</a>
								</li> -->
							</ul>
							<!-- /nav-second-level -->
						</li>

						<li class="">
							<a href="{{route('products.index')}}"><i class="fa fa-dropbox nav_icon"></i>Produits <span class="fa arrow"></span></a>
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
							<a href="{{route('usermanagements.index')}}"><i class="fa fa-user nav_icon"></i>Utilisateurs<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('usermanagements.index')}}">Liste des Utilisateurs</a>
								</li>
								<li>
									<a href="{{route('usermanagements.create')}}">Ajouter Utilisateur</a>
								</li>
                                <li>
									<a href="{{route('users.index')}}">Non Approuvés <span class="nav-badge">12</span> </a>
								</li>
							</ul>
							<!-- //nav-second-level -->
						</li>
                        <li class="">
							<a href="{{route('admin.order.index')}}"><i class="fa fa-folder nav_icon"></i>Commandes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('admin.order.index')}}">Liste des Commandes</a>
								</li>
                                <li>
									<a href="{{route('order.approved.index')}}">Commandes Approuvées</a>
								</li>
								<li>
									<a href="{{route('orders.create')}}">Ajouter une Commande</a>
								</li>
                                <li>
									<a href="{{route('orders.situation')}}">Point de Vente</a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li class="">
							<a href="{{route('products.index')}}"><i class="fa fa-money nav_icon"></i>Mes ventes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('sellings.index')}}">Liste des Ventes <span class="nav-badge">12</span></a>
								</li>
                                <li>
									<a href="{{route('sellings.index')}}">Liste des Écarts <span class="nav-badge">12</span></a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li>
							<a href="{{route('orders.situation')}}"><i class="fa fa-bar-chart nav_icon"></i>Statistique</a>
						</li>
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
    @elseif (Auth::user()->is_admin == 2)

    <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="{{route('admin.home')}}" class="active"><i class="fa fa-home nav_icon"></i>Tableau de board</a>
						</li>
                        <li>
							<a href="{{route('category.index')}}"><i class="fa fa-list-alt nav_icon"></i>Catégories</a>
						</li>
                        <li>
							<a href="{{route('product.index')}}"><i class="fa fa-dropbox nav_icon"></i>Produits</a>
						</li>
                        <li class="">
							<a href="{{route('admin.order.index')}}"><i class="fa fa-folder nav_icon"></i>Commandes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
                                <li>
									<a href="{{route('order.approved.index')}}">Commandes Approuvées</a>
								</li>
								<li>
									<a href="{{route('orders.create')}}">Ajouter une Commande</a>
								</li>
                                <li>
									<a href="{{route('orders.situation')}}">Point de Vente</a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li class="">
							<a href="{{route('products.index')}}"><i class="fa fa-money nav_icon"></i>Mes ventes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('sellings.index')}}">Liste des Ventes <span class="nav-badge">12</span></a>
								</li>
                                <li>
									<a href="{{route('sellings.index')}}">Liste des Écarts <span class="nav-badge">12</span></a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li>
							<a href="{{route('orders.situation')}}"><i class="fa fa-bar-chart nav_icon"></i>Statistique</a>
						</li>
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
    @else
        <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="{{route('admin.home')}}" class="active"><i class="fa fa-home nav_icon"></i>Tableau de board</a>
						</li>
                        <li>
							<a href="{{route('category.index')}}"><i class="fa fa-list-alt nav_icon"></i>Catégories</a>
						</li>
                        <li>
							<a href="{{route('product.index')}}"><i class="fa fa-dropbox nav_icon"></i>Produits</a>
						</li>
                        <li class="">
							<a href="{{route('admin.order.index')}}"><i class="fa fa-folder nav_icon"></i>Commandes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
                                <li>
									<a href="{{route('orders.index')}}">Mes Commandes</a>
								</li>
								<li>
									<a href="{{route('orders.create')}}">Ajouter une Commande</a>
								</li>
                                <li>
									<a href="{{route('orders.situation')}}">Point de Vente</a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li class="">
							<a href="{{route('products.index')}}"><i class="fa fa-money nav_icon"></i>Mes ventes <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{route('sellings.index')}}">Liste des Ventes <span class="nav-badge">12</span></a>
								</li>
                                <li>
									<a href="{{route('sellings.index')}}">Liste des Écarts <span class="nav-badge">12</span></a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>

                        <li>
							<a href="{{route('orders.situation')}}"><i class="fa fa-bar-chart nav_icon"></i>Statistique</a>
						</li>
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
@endif
