<nav>
	<div id="nav">
		<ul id="menu">
			<li class="nav">
				<a class="title-header" href="index.php">Acceuil</a>
			</li>
			<li class="nav">
				<a class="title-header" href="products.php">Produits</a>
			</li>
			<?php if (isset($_SESSION["user"])) { ?>
				<li class="nav">
					<a class="title-header" href="profile.php">Mon compte</a>
                    <ul class="cat">
                        <li class="sub">
                            <a class="name-header" href="basket.php">Mon panier</a>
                        </li>
                        <li class="sub">
                            <a class="name-header" href="orders.php">Mes commandes</a>
                        </li>
                        <li class="sub">
                            <a class="name-header" href="wishlist.php">Ma liste d'envies</a>
                        </li>
                        <li class="sub">
                            <a class="name-header" href="edit-profile.php">Modifier mon compte</a>
                        </li>
		                <?php if ($_SESSION["user"]->getRank() > 0) { ?>
		                    <li class="sub">
		                        <a class="name-header" href="admin.php">Gérer le site</a>
		                    </li>
		                <?php } ?>
                        <li class="sub">
							<a class="name-header" href="disconnect.php">Déconnexion</a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
				<li class="nav">
					<a class="title-header" href="register.php">Inscription</a>
				</li>
				<li class="nav">
					<a class="title-header" href="login.php">Connexion</a>
				</li>
			<?php } ?>
		</ul>
	</div>
</nav>