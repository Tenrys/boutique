<?php

function mysql_timestamp(DateTime $date) {
	return date("Y-m-d H:i:s", $date->getTimestamp());
}

function index() {
	header("Location: index.php");
	die;
}

function show_rating(ShopItem $product) {
	if (method_exists($product, "getRating")) {
	?>
	<div class="rating">
		<span style="clip-path: inset(0 <?= (1 - max(0, min(1, $product->getRating() / 5))) * 100 ?>% 0 0);">
			⭐⭐⭐⭐⭐
		</span>
	</div>
	<?php } else {
		throw new InvalidArgumentException(__METHOD__ . " requires an object inheriting ShopItem that implements method getRating");
	}
}

$ranks = [
	0 => "Utilisateur",
	1 => "Admin",
];

$sortMethods = [
    "popularity" => [
        "niceName" => "Popularité",
        "sort" => function($a, $b) {
            $aPop = $a->getRating();
            $bPop = $b->getRating();
            if ($aPop == $bPop) {
                return 0;
            } else if ($aPop < $bPop) {
                return 1;
            } else {
                return -1;
            }
        }
    ],
    "price" => [
        "niceName" => "Prix",
        "sort" => function($a, $b) {
            $aPop = $a->getPrice();
            $bPop = $b->getPrice();
            if ($aPop == $bPop) {
                return 0;
            } else if ($aPop < $bPop) {
                return 1;
            } else {
                return -1;
            }
        }
    ],
    "release" => [
        "niceName" => "Date de sortie",
        "sort" => function($a, $b) {
            $aPop = $a->getDate()->getTimestamp();
            $bPop = $b->getDate()->getTimestamp();
            if ($aPop == $bPop) {
                return 0;
            } else if ($aPop < $bPop) {
                return 1;
            } else {
                return -1;
            }
        }
    ]
];

?>