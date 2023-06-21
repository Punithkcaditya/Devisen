<?php $user = $this->session->userdata('login_user_id'); ?>
<header id="home">
    <!-- sticky menu -->
    <div class="stick-wrapper">
        <div class="sticky clear">
            <div class="grid-row">
                <div class="logo mt-3">
                    <?php
                   
                    ?>
                    <a href="<?php echo $settings->LOGO_LINK; ?>"><img src="uploads/settings/<?php echo $settings->LOGO_IMAGE; ?>" alt="logo" /></a>
                </div>
                <a href="#" class="switcher">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M438,0H74C33.196,0,0,33.196,0,74s33.196,74,74,74h364c40.804,0,74-33.196,74-74S478.804,0,438,0z M438,108H74    c-18.748,0-34-15.252-34-34s15.252-34,34-34h364c18.748,0,34,15.252,34,34S456.748,108,438,108z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M438,182H74c-40.804,0-74,33.196-74,74s33.196,74,74,74h364c40.804,0,74-33.196,74-74S478.804,182,438,182z M438,290H74    c-18.748,0-34-15.252-34-34s15.252-34,34-34h364c18.748,0,34,15.252,34,34S456.748,290,438,290z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M438,364H74c-40.804,0-74,33.196-74,74s33.196,74,74,74h264c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H74    c-18.748,0-34-15.252-34-34s15.252-34,34-34h364c18.748,0,34,15.252,34,34s-15.252,34-34,34c-11.046,0-20,8.954-20,20    c0,11.046,8.954,20,20,20c40.804,0,74-33.196,74-74S478.804,364,438,364z"/>
                            </g>
                        </g>
                    </svg>
                </a>
                <nav class="nav">
                    <div class="top-links"  data-aos="fade-down" data-aos-duration="1000">
                        <ul>
                            <li><a href="<?php if(isset($user) && $user > 0){ echo "live-market"; } else { echo "login";} ?>"><i class="fa fa-eye"></i> Live Markets</a></li>
                            <!-- <li><a href="<?php if(isset($user) && $user > 0){ echo "calculator"; } else { echo "login";} ?>"><i class="fa fa-calculator"></i> Calculators</a></li> -->
                            <li><a href="<?php if(isset($user) && $user > 0){ echo "broken-calculator"; } else { echo "login";} ?>"><i class="fa fa-bar-chart"></i> Forward Rate Calculator</a></li>
                            <li style="display:none"><a href="<?php if(isset($user) && $user > 0){ echo "live-market"; } else { echo "login";} ?>"><i class="fa fa-bar-chart"></i> Exposure Management</a></li>
                        </ul>
                    </div>
                    <ul class="clear" data-aos="fade-left" data-aos-duration="800">
                        <?php if (!empty($header_menu)):  ?>
                        
                            <?php foreach ($header_menu as $header_menu): ?>
                                <?php
                                if($header_menu->menuitem_link == 'Historical-Rates'){
                                    if(isset($user) && $user > 0){
                                        $header_menu->menuitem_link = '#';
                                    } else {
                                        $header_menu->menuitem_link = 'login';
                                    }
                                } 
                                if($header_menu->menuitem_link == 'fx'){
                                    if(isset($user) && $user > 0){
                                        $header_menu->menuitem_link = 'fx';
                                    } else {
                                        $header_menu->menuitem_link = 'login';
                                    }
                                }
                                ?>
                                <li><a target="<?php echo $header_menu->menuitem_target; ?>"  href="<?php echo $header_menu->menuitem_link; ?>"><?php echo $header_menu->menuitem_text; ?> <?php echo (!empty($header_menu->submenu)) ? '<i class="fa fa-angle-down">' : ''; ?></i></a>
                                    <?php  if (!empty($header_menu->submenu)):  ?>
                                        <ul >
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
                            <li><a href="javascript:void(0);">My Account</a>
                                <ul class="dropdown">
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
                </nav>
            </div>
        </div>
    </div>
    <!--/ sticky menu -->
</header>