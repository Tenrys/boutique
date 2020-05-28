<nav>
	<div id="nav">
		<ul id="menu">
			<li class="nav">
				<a class="title-header" href="index.php">Accueil</a>
			</li>
			<li class="nav">
				<a class="title-header" href="products.php">Produits</a>
				<ul class="cat">
					<?php foreach (Category::Find() as $category) { ?>
					<li class="sub">
						<a class="name-header" href="products.php?category=<?= $category->getId() ?>"><?= $category->getName() ?></a>
						<?php foreach(SubCategory::Find(["id_category" => $category->getId()]) as $subcategory) { ?>
							<li class="nav-sub">
								<a class="name-header" href="products.php?category=<?= $category->getId() ?>&subcategory=<?= $subcategory->getId() ?>"><?= $subcategory->getName() ?></a>
							</li>
						<?php } ?>
					</li>
					<?php } ?>
				</ul>
			</li>
			<?php if (isset($_SESSION["user"])) { ?>
				<li class="nav">
					<a class="title-header" href="profile.php">Mon compte</a>
                    <ul class="cat">
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
						</ul>
						<li class="nav">
                            <a class="title-header" href="basket.php">Mon panier</a>
                        </li>
                        <li class="nav">
							<a class="title-header" href="disconnect.php">Déconnexion</a>
                        </li>
                </li>
            <?php } else { ?>
				<li class="nav">
					<a class="title-header" href="register.php">Inscription</a>
				</li>
				<li class="nav">
					<a class="title-header" href="login.php">Connexion</a>
				</li>
			<?php } ?>
			<li class="nav">
				<form action="products.php" method="GET">
					<input
						type="search"
						name="search_query"
						value="<?= @$_GET["search_query"] ?? "" ?>"
						placeholder="🔎 Rechercher..."
						<?= basename($_SERVER["SCRIPT_NAME"]) == "products.php" ? "form='filter'" : "" ?>
					>
				</form>
			</li>
		</ul>
	</div>
</nav>