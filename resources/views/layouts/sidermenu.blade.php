<?php
use App\My\Menu ;
?>
<ul class="nav nav-pills flex-column">


    <?php
            Menu::gen_menu() ;
    ?>

</ul>