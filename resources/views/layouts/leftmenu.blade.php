
<?php
use App\My\Menu ;
?>





<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">



        <?php
//        Menu::gen_menu() ;
        ?>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="pages/ui-features/buttons.html" aria-expanded="false" aria-controls="ui-basic">
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">

                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                    </li>
                </ul>
            </div>
        </li>
                <span class="menu-title">满意评测管理</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">企业端</a>
                    </li>                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">维权端</a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
<!-- partial -->