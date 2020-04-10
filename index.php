<html>

<?php

require 'class/bdd.php';
require 'class/user.php';

session_start();

if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}

?>

<head>
        <title>Accueil</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main class="main">


<div>
    <span>
        <h1>Medium title</h1>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non quam nec eros dignissim rutrum ut non orci. Proin dignissim efficitur dictum. Phasellus volutpat dolor vel euismod egestas. Quisque sed risus finibus, tincidunt nisi non, blandit nisl. Phasellus efficitur semper ante, vitae pharetra quam sodales sed. Suspendisse potenti. Curabitur sit amet arcu quis augue commodo gravida. Vestibulum venenatis enim et orci vulputate, at sodales est pharetra. Sed eleifend dui et ipsum maximus, id tempus nunc tincidunt. Cras at malesuada ante. Nullam aliquet sit amet tortor in elementum. Praesent quis diam a orci varius consequat ac sed massa. Vestibulum facilisis mi sit amet massa dapibus commodo.

Integer ullamcorper lobortis facilisis. Nunc pretium posuere lacus et ultrices. Cras ac purus lectus. Morbi vulputate suscipit vehicula. Duis imperdiet pretium neque, eget sollicitudin ex. Nullam efficitur fringilla metus ut posuere. In eget metus malesuada quam tristique ultricies feugiat vel justo. Duis et velit fringilla, commodo nibh vel, elementum ex. Fusce sit amet gravida tellus, eu iaculis mi.

Cras at turpis porta, volutpat arcu vel, consectetur felis. Cras ultricies enim at mi tempor, quis aliquam ligula eleifend. Maecenas consectetur vulputate lorem, nec eleifend velit. Integer pharetra vulputate porta. Sed commodo vestibulum malesuada. Ut porttitor, libero et volutpat fermentum, dolor orci semper augue, at ultricies orci felis ut sem. Sed pulvinar risus non erat auctor porttitor. Sed in sollicitudin neque, id vulputate felis. In bibendum laoreet nisl in finibus. Nulla elementum nulla arcu. Sed placerat velit ac lectus maximus, vel aliquet nisi faucibus. Integer eu vulputate enim.

Proin sollicitudin, nunc eget iaculis hendrerit, risus ipsum feugiat nisi, eu varius nisl mauris at risus. Vivamus semper, magna in accumsan fermentum, velit lacus suscipit turpis, quis pellentesque metus nisi at lectus. Nunc condimentum in risus eu auctor. Vivamus posuere odio justo, in aliquam eros eleifend sit amet. Suspendisse a mi ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi a dui vel metus auctor imperdiet eu nec dolor. Nunc tempus urna non dictum accumsan. Sed et tempor eros, ut fermentum dui. Praesent rutrum leo eu sollicitudin dictum. Curabitur suscipit accumsan mollis. Nullam bibendum enim fermentum, congue ex a, gravida felis. Etiam nec ex commodo, tempor est ut, dictum lectus.
    </span>
</div>


</main>

    <?php require 'include/footer.php'?>

</body>

</html>
