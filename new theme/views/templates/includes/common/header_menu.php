<?php $user = $this->session->userdata('login_user_id'); ?>

  <!-- Preloader Start -->
  <!-- <div class="se-pre-con"></div> -->
    <!-- Preloader Ends -->

    <!-- Start Header Top 
    ============================================= -->
    <div class="top-bar-area blue inc-border inline pad-less transparent">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="info">
                    <ul>
                            <li><a href="<?php if(isset($user) && $user > 0){ echo "live-market"; } else { echo "login";} ?>"><i class="fa fa-eye"></i> Live Markets</a></li>
                            <li><a href="<?php if(isset($user) && $user > 0){ echo "broken-calculator"; } else { echo "login";} ?>"><i class="fas fa-chart-bar"></i> Forward Rate Calculator</a></li>
                            <li style="display:none"><a href="<?php if(isset($user) && $user > 0){ echo "live-market"; } else { echo "login";} ?>"><i class="fa fa-bar-chart"></i> Exposure Management</a></li>
                        </ul>
                       
                    </div>
                </div>
                <div class="col-md-4 button text-right">
                    <a href="#">Free Analysis</a>
                </div>
            </div>
        </div>
    </div>
  <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar blue navbar-default navbar-fixed dark no-background bootsnav inc-pad">

            <div class="container">

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo $settings->LOGO_LINK; ?>">
                        <img src="uploads/settings/<?php echo $settings->LOGO_IMAGE; ?>" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                    <?php if (!empty($header_menu)):  ?>
                        
                        <?php foreach ($header_menu as $header_menu): ?>
                            <?php
                            if($header_menu->menuitem_link == 'Historical-Rates'){
                                $classli = 'dropdown';
                                $classliul = 'dropdown-toggle';
                                $datatog = "dropdown";
                                if(isset($user) && $user > 0){
                                    $header_menu->menuitem_link = '#';
                                } else {
                                    $header_menu->menuitem_link = 'login';
                                }
                            }else{
                                $classli = '';
                                $classliul = '';
                                $datatog = '';
                            } 
                            if($header_menu->menuitem_link == 'fx'){
                                if(isset($user) && $user > 0){
                                    $header_menu->menuitem_link = 'fx';
                                } else {
                                    $header_menu->menuitem_link = 'login';
                                }
                            }
                            ?> 
                  <li <?php echo !empty($classli) ? 'class="' . $classli . '"' : ''; ?>>
                            <a href="<?php echo $header_menu->menuitem_link; ?>" <?php echo !empty($classliul) ? 'class="' . $classliul . '"' : ''; ?> <?php echo !empty($datatog) ?  'data-toggle="' . $datatog . '"' : ''; ?> target="<?php echo $header_menu->menuitem_target; ?>"  href="<?php echo $header_menu->menuitem_link; ?>"><?php echo $header_menu->menuitem_text; ?> <?php echo (!empty($header_menu->submenu)) ? '' : ''; ?></i></a>
                            <?php  if (!empty($header_menu->submenu)):  ?>
                            <ul class="dropdown-menu">
                                            <?php foreach ($header_menu->submenu as $submenu): ?>
                                                <?php
                                                if($submenu->menuitem_link == 'Historical-Rates' 
												|| $submenu->menuitem_link == 'Spot-Rates'
												|| $submenu->menuitem_link == 'Forward-Rates'
												|| $submenu->menuitem_link == 'LIBOR-Rates'
												){
                                                    if(isset($user) && $user > 0){

                                                    } else {
                                                        $submenu->menuitem_link = 'login';
                                                    }
                                                } ?>
                                                <li><a target="<?php echo $submenu->menuitem_target; ?>" href="<?php echo $submenu->menuitem_link; ?>"><?php echo $submenu->menuitem_text; ?> <?php echo (!empty($submenu->submenu)) ? '<i class="fa fa-angle-right"></i>' : ''; ?></a>
                                                    <?php if (!empty($submenu->submenu)): ?>
                                                        <?php foreach ($submenu->submenu as $submenu_2): 
														
                                                if($submenu_2->menuitem_link == 'Spot-Rates'
												|| $submenu_2->menuitem_link == 'Forward-Rates'
												|| $submenu_2->menuitem_link == 'LIBOR-Rates'
												){
                                                    if(isset($user) && $user > 0){

                                                    } else {
                                                        $submenu_2->menuitem_link = 'login';
                                                    }
                                                } ?>
														
                                                            <ul>
                                                                <li><a target="<?php echo $submenu_2->menuitem_target; ?>" href="<?php echo $submenu_2->menuitem_link ?>"><?php echo $submenu_2->menuitem_text ?></a></li>
                                                            </ul>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif;  ?>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php
                        if(isset($user) && $user > 0){ ?>
                            <li class='dropdown'><a href="javascript:void(0);"   class = 'dropdown-toggle'
                                data-toggle = "dropdown">My Account</a>
                                <ul class="dropdown-menu">
                                    <li><a href="my-account">Profile</a></li>
                                    <li><a href="change-password">Change Password</a></li>
                                    <li><a href="my-alerts">Create Price Alert</a></li>
                                    <li><a href="logout">Sign Out</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a href="login">Login/Register</a></li>
                        <?php } ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>

        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->






