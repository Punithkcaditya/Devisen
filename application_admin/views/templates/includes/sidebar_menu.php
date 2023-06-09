<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active treeview">
                <a href="<?php echo base_url(); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <?php if (!empty($_SESSION['sidebar_menuitems'])): ?>
                <?php foreach ($_SESSION['sidebar_menuitems'] as $main_menus): ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span><?php echo $main_menus->menuitem_text; ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <?php if (!empty($main_menus->submenus)): ?>
                            <ul class="treeview-menu">
                                <?php foreach ($main_menus->submenus as $submenus): ?>
                                    <li><a href="<?php echo $submenus->menuitem_link; ?>"><i class="fa fa-circle-o"></i> <?php echo $submenus->menuitem_text; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>