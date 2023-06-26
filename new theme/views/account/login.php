<style>


.loginWrapper {
    padding-top: 14em;
	display: block;
	position: relative;
	width: 50em;
	text-align: center;	
	margin: auto;
	right: 0;
	left: 0;
	margin-top: 60px;
	margin-bottom: 60px;
	z-index: 1;
	transition: box-shadow 1s;
}

.logginFormFooter {
	text-align: center;
	color: #777;
	width: 100%;
	font-size: 12px;
	position: fixed;
	bottom: 10px;
}

	.logginFormFooter a       {color: #777; font-weight: 600;}
	.logginFormFooter a:hover {color: #AAA;}



nav {
  z-index: 9;
  color: #FFF;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px 0;
  text-align: center;
}

.tabs {
  display: table;
  table-layout: fixed;
  width: 100%;
  -webkit-transform: translateY(5px);
  transform: translateY(5px);
}

.tabs > li {
    min-height: 280px;
  transition-duration: .25s;
  display: table-cell;
  list-style: none;
  text-align: center;
  padding: 20px 20px 25px 20px;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  color: #666;
  background-color: none;

}
.tabs > li:before {
  z-index: -1;
  position: absolute;
  content: "";
  width: 100%;
  height: 120%;
  color: #FFF;  
  top: 0;
  left: 0;
 	background-color: #DDD;
  -webkit-transform: translateY(100%);
  transform: translateY(100%);
  transition-duration: .25s;
  border-radius: 8px 8px 0 0;
}

.tabs > li:hover:before {
  -webkit-transform: translateY(70%);
  transform: translateY(70%);
}
.tabs > li.active {
    color: #232323;
    font-weight: 700;
}
.tabs > li.active:before {
  transition-duration: .5s;
 	background-color: #f4f7fc;
  -webkit-transform: translateY(0);
  transform: translateY(0);
}

.tab__content {
  background-color: white;
  position: relative;
  width: 100%;
  border-radius: 5px 5px 0px 0px;
 	background-color: #f4f7fc;
-webkit-box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
-moz-box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
 
}
.tab__content > li {
  width: 100%;
  position: absolute;
  border-radius: 5px;
  color: #FFF;
  top: 0;
  left: 0;
  background-color: #f4f7fc;
  display: none;
  list-style: none;
}
.tab__content > li .content__wrapper {
  text-align: center;
  border-radius: 5px;
  padding-top: 24px;
  background-color: #f4f7fc;
}


	form input {
		border: none;
		padding: 12px;
		background: #EEE;
		font-size: 16px;
		margin: 12px 0px;
		width: 300px;
		font-weight: 100;
    	outline: none;
	}

	form input:first-child {margin-top: 8px;}
	form input:last-child {margin-top: 16px; margin-bottom: 0px;}

	form input:focus {background-color: #FFF;}
	form input:hover {background-color: #FFF;}
	form input:placeholder {color: blue;}

	form [type="submit"]:focus,
	form [type="submit"]:hover {background: #009CEF;}

	form [type="submit"] {
		background: #3399DD;
		color: #FFF;
		padding: 4px;
		width: 30%;
		cursor: pointer;
	}

	::-webkit-input-placeholder {color: #DDD;}
	:-moz-placeholder           {color: #DDD;}
	::-moz-placeholder          {color: #DDD;}
	:-ms-input-placeholder      {color: #DDD;}


.loginWrapper .form-group{
    position: relative;
}

.loginWrapper .form-group span{
    display: inline-block;
    position: absolute;
    right: 15px;
    top: 12px;
}

.loginWrapper .form-group svg{
    width: 22px;
    height: 22px;
    fill: #5d5d5d;
}
    
.frame-btn.btn-2, .frame-btn.btn-3{
  line-height: 10px;
  display: inline-block;
  padding: 15px;
  font-size: 14px;
  letter-spacing: 2px;
  text-decoration: none;
  position: relative;
}
.frame-btn.btn-3{
    background: #1cb9c8;
    width: 30%;
}

.input-group-addon button{
    width: 100%;
}

nav.navbar.bootsnav.no-background.inc-pad {
    margin-top: unset !important;
}

    </style>
<!-- second -->
<section class="loginWrapper">
  
	<ul class="tabs">
		<li class="active">Login</li>
		<li>Register</li>
	</ul>

	<ul class="tab__content">
    
		<li class="active">
			<div class="content__wrapper">
                <?php
                            $msg = $this->session->flashdata('msg');
                            if (!empty($msg['txt']) ):
                                ?>
                                <div class="alert alert-<?php echo $msg['type']; ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $msg['txt']; ?> </strong>
                                </div>
                            <?php endif ?>
                <form class="register-form" method="post" id="login-form" action="loginfun" name="from_url"  enctype="multipart/form-data" style="padding: 2em;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                            <input type="text" name="user_name" id="user_name" required class="form-control" placeholder="Email/Mobile Number">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 512 512" width="35px"><path d="m471.386719 325.011719c-16.96875-14.910157-37.546875-27.792969-61.167969-38.289063-10.097656-4.484375-21.914062.0625-26.398438 10.15625-4.484374 10.09375.0625 21.910156 10.15625 26.398438 19.917969 8.851562 37.082032 19.542968 51.007813 31.78125 17.167969 15.085937 27.015625 36.929687 27.015625 59.941406v37c0 11.027344-8.972656 20-20 20h-392c-11.027344 0-20-8.972656-20-20v-37c0-23.011719 9.847656-44.855469 27.015625-59.941406 20.207031-17.757813 79.082031-59.058594 188.984375-59.058594 81.605469 0 148-66.394531 148-148s-66.394531-148-148-148-148 66.394531-148 148c0 47.707031 22.695312 90.207031 57.851562 117.289062-64.328124 14.140626-104.34375 41.359376-125.238281 59.722657-25.808593 22.675781-40.613281 55.472656-40.613281 89.988281v37c0 33.085938 26.914062 60 60 60h392c33.085938 0 60-26.914062 60-60v-37c0-34.515625-14.804688-67.3125-40.613281-89.988281zm-323.386719-177.011719c0-59.550781 48.449219-108 108-108s108 48.449219 108 108-48.449219 108-108 108-108-48.449219-108-108zm0 0"/></svg></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" height="35px" width="35px" xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <circle cx="370" cy="346" r="20"/>
                                                                <path d="M460,362c11.046,0,20-8.954,20-20v-74c0-44.112-35.888-80-80-80h-24.037v-70.534C375.963,52.695,322.131,0,255.963,0     s-120,52.695-120,117.466V188H112c-44.112,0-80,35.888-80,80v164c0,44.112,35.888,80,80,80h288c44.112,0,80-35.888,80-80     c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20c0,22.056-17.944,40-40,40H112c-22.056,0-40-17.944-40-40V268     c0-22.056,17.944-40,40-40h288c22.056,0,40,17.944,40,40v74C440,353.046,448.954,362,460,362z M335.963,188h-160v-70.534     c0-42.715,35.888-77.466,80-77.466s80,34.751,80,77.466V188z"/>
                                                                <circle cx="219" cy="346" r="20"/>
                                                                <circle cx="144" cy="346" r="20"/>
                                                                <circle cx="294" cy="346" r="20"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                &nbsp;&nbsp;
                                <button class="frame-btn btn-2" type="submit">
                                 Login
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="frame-btn btn-3" type="reset">
                                  Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</li>
   
		<li>
			<div class="content__wrapper">
                <?php
                $msg = $this->session->flashdata('msg');
      
                if (!empty($msg['txt'])):
                    ?>
                    <div class="alert alert-<?php echo $msg['type']; ?>" style="background: gainsboro;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong style="color: red;"><?php echo $msg['txt']; ?> </strong>
                    </div>
                <?php endif ?>
                <form class="register-form" method="post" id="register-form" action="completeregistration" name="from_url"  enctype="multipart/form-data" style="padding: 2em;">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="form-group">
                                <input id="reg_email" class="form-control" type="email" name="email" placeholder="Enter Email Address" required>
                                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.974 511.974" style="enable-background:new 0 0 511.974 511.974;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M511.872,195.725c-0.053-0.588-0.17-1.169-0.35-1.732c-0.117-0.503-0.28-0.994-0.486-1.468     c-0.239-0.463-0.525-0.901-0.853-1.306c-0.329-0.481-0.71-0.924-1.135-1.323c-0.137-0.119-0.196-0.282-0.341-0.401     l-82.065-63.735V59.704c0-14.138-11.462-25.6-25.6-25.6h-92.476L271.539,5.355c-9.147-7.134-21.974-7.134-31.121,0     l-37.035,28.749h-92.476c-14.138,0-25.6,11.461-25.6,25.6v66.057L3.268,189.496c-0.145,0.12-0.205,0.282-0.341,0.401     c-0.425,0.398-0.806,0.842-1.135,1.323c-0.328,0.405-0.614,0.842-0.853,1.306c-0.207,0.473-0.369,0.965-0.486,1.468     c-0.178,0.555-0.295,1.127-0.35,1.707c0,0.179-0.102,0.333-0.102,0.512V486.37c0.012,5.428,1.768,10.708,5.009,15.061     c0.051,0.077,0.06,0.171,0.119,0.239c0.06,0.068,0.188,0.145,0.273,0.239c4.794,6.308,12.25,10.027,20.173,10.061h460.8     c7.954-0.024,15.441-3.761,20.241-10.103c0.068-0.085,0.171-0.111,0.23-0.196c0.06-0.085,0.068-0.162,0.12-0.239     c3.241-4.354,4.997-9.634,5.009-15.061V196.237C511.974,196.058,511.881,195.904,511.872,195.725z M250.854,18.82     c2.98-2.368,7.2-2.368,10.18,0l19.686,15.283h-49.493L250.854,18.82z M27.725,494.904l223.13-173.321     c2.982-2.364,7.199-2.364,10.18,0l223.189,173.321H27.725z M494.908,481.6L271.539,308.117c-9.149-7.128-21.972-7.128-31.121,0     L17.041,481.6V209.233L156.877,317.82c3.726,2.889,9.088,2.211,11.977-1.515c2.889-3.726,2.211-9.088-1.515-11.977     L25.276,194.018l60.032-46.652v65.937c0,4.713,3.821,8.533,8.533,8.533c4.713,0,8.533-3.821,8.533-8.533v-153.6     c0-4.713,3.82-8.533,8.533-8.533h290.133c4.713,0,8.533,3.82,8.533,8.533v153.6c0,4.713,3.82,8.533,8.533,8.533     s8.533-3.821,8.533-8.533v-65.937l60.032,46.652l-142.31,110.507c-2.448,1.855-3.711,4.883-3.305,7.928s2.417,5.637,5.266,6.786     c2.849,1.149,6.096,0.679,8.501-1.232l140.083-108.774V481.6z"/>
                                                <path d="M358.374,204.77v-34.133c0-56.554-45.846-102.4-102.4-102.4c-56.554,0-102.4,45.846-102.4,102.4     s45.846,102.4,102.4,102.4c4.713,0,8.533-3.82,8.533-8.533s-3.82-8.533-8.533-8.533c-47.128,0-85.333-38.205-85.333-85.333     s38.205-85.333,85.333-85.333s85.333,38.205,85.333,85.333v34.133c0,9.426-7.641,17.067-17.067,17.067     s-17.067-7.641-17.067-17.067v-34.133c0-4.713-3.82-8.533-8.533-8.533s-8.533,3.82-8.533,8.533     c0,18.851-15.282,34.133-34.133,34.133c-18.851,0-34.133-15.282-34.133-34.133s15.282-34.133,34.133-34.133     c4.713,0,8.533-3.82,8.533-8.533s-3.82-8.533-8.533-8.533c-22.915-0.051-43.074,15.13-49.354,37.168     c-6.28,22.038,2.847,45.565,22.347,57.601c19.5,12.036,44.622,9.65,61.507-5.843c1.858,18.046,17.543,31.464,35.659,30.505     C344.25,237.91,358.431,222.912,358.374,204.77z"/>
                                            </g>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" height="35px" width="35px" xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <circle cx="370" cy="346" r="20"/>
                                                                <path d="M460,362c11.046,0,20-8.954,20-20v-74c0-44.112-35.888-80-80-80h-24.037v-70.534C375.963,52.695,322.131,0,255.963,0     s-120,52.695-120,117.466V188H112c-44.112,0-80,35.888-80,80v164c0,44.112,35.888,80,80,80h288c44.112,0,80-35.888,80-80     c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20c0,22.056-17.944,40-40,40H112c-22.056,0-40-17.944-40-40V268     c0-22.056,17.944-40,40-40h288c22.056,0,40,17.944,40,40v74C440,353.046,448.954,362,460,362z M335.963,188h-160v-70.534     c0-42.715,35.888-77.466,80-77.466s80,34.751,80,77.466V188z"/>
                                                                <circle cx="219" cy="346" r="20"/>
                                                                <circle cx="144" cy="346" r="20"/>
                                                                <circle cx="294" cy="346" r="20"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                            </div>
                        </div>
                    </div>
<!-- 2 -->
                <div class="col-md-5">
                <div class="row">
                    <div class="form-group">
                        <input type="text" name="full_name" placeholder="Enter Full Name" type="email" required class="form-control"/>
                        <span><svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 0 512 512" width="35px"><path d="m471.386719 325.011719c-16.96875-14.910157-37.546875-27.792969-61.167969-38.289063-10.097656-4.484375-21.914062.0625-26.398438 10.15625-4.484374 10.09375.0625 21.910156 10.15625 26.398438 19.917969 8.851562 37.082032 19.542968 51.007813 31.78125 17.167969 15.085937 27.015625 36.929687 27.015625 59.941406v37c0 11.027344-8.972656 20-20 20h-392c-11.027344 0-20-8.972656-20-20v-37c0-23.011719 9.847656-44.855469 27.015625-59.941406 20.207031-17.757813 79.082031-59.058594 188.984375-59.058594 81.605469 0 148-66.394531 148-148s-66.394531-148-148-148-148 66.394531-148 148c0 47.707031 22.695312 90.207031 57.851562 117.289062-64.328124 14.140626-104.34375 41.359376-125.238281 59.722657-25.808593 22.675781-40.613281 55.472656-40.613281 89.988281v37c0 33.085938 26.914062 60 60 60h392c33.085938 0 60-26.914062 60-60v-37c0-34.515625-14.804688-67.3125-40.613281-89.988281zm-323.386719-177.011719c0-59.550781 48.449219-108 108-108s108 48.449219 108 108-48.449219 108-108 108-108-48.449219-108-108zm0 0"/></svg></span>
                    </div>
                </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                <div class="row">
                    <div class="form-group">
                        <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control">
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 511.999 511.999"  xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M142.715,82.068h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449V92.517C153.164,86.747,148.485,82.068,142.715,82.068z M132.266,139.537h-15.674v-36.571    h15.674V139.537z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M215.858,82.068h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449V92.517C226.307,86.747,221.628,82.068,215.858,82.068z M205.409,139.537h-15.673v-36.571    h15.673V139.537z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M142.715,184.467h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C153.164,189.147,148.485,184.467,142.715,184.467z M132.266,241.937h-15.674v-36.571    h15.674V241.937z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M215.858,184.467h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C226.307,189.147,221.628,184.467,215.858,184.467z M205.409,241.937h-15.673v-36.571    h15.673V241.937z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M142.715,286.867h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C153.164,291.547,148.485,286.867,142.715,286.867z M132.266,344.337h-15.674v-36.571    h15.674V344.337z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M215.858,286.867h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C226.307,291.547,221.628,286.867,215.858,286.867z M205.409,344.337h-15.673v-36.571    h15.673V344.337z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M142.715,389.267h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C153.164,393.947,148.485,389.267,142.715,389.267z M132.266,446.737h-15.674v-36.571    h15.674V446.737z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M215.858,389.267h-36.571c-5.77,0-10.449,4.679-10.449,10.449v57.469c0,5.77,4.679,10.449,10.449,10.449h36.571    c5.77,0,10.449-4.679,10.449-10.449v-57.469C226.307,393.947,221.628,389.267,215.858,389.267z M205.409,446.737h-15.673v-36.571    h15.673V446.737z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,422.486h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,427.165,406.276,422.486,400.506,422.486z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,176.087h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,180.766,406.276,176.087,400.506,176.087z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,225.367h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,230.046,406.276,225.367,400.506,225.367z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,274.646h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,279.325,406.276,274.646,400.506,274.646z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,323.926h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,328.605,406.276,323.926,400.506,323.926z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M400.506,373.206h-0.187c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h0.187    c5.77,0,10.449-4.679,10.449-10.449C410.955,377.885,406.276,373.206,400.506,373.206z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M479.085,491.101H450.47V136.957c0-5.77-4.679-10.449-10.449-10.449H266.535V55.379c0-4.845-3.331-9.055-8.046-10.169    L68.318,0.279c-3.109-0.732-6.382-0.006-8.887,1.976c-2.506,1.98-3.965,4.999-3.965,8.193v480.653H32.914    c-5.77,0-10.449,4.679-10.449,10.449c0,5.77,4.679,10.449,10.449,10.449h446.171c5.77,0,10.449-4.679,10.449-10.449    C489.534,495.78,484.855,491.101,479.085,491.101z M245.637,136.957v354.144H76.364V23.652l169.273,39.993V136.957z     M429.572,491.101H266.535v-47.716h97.872c5.77,0,10.449-4.679,10.449-10.449c0-5.77-4.679-10.449-10.449-10.449h-97.872v-28.381    h97.872c5.77,0,10.449-4.679,10.449-10.449c0-5.77-4.679-10.449-10.449-10.449h-97.872v-28.383h97.872    c5.77,0,10.449-4.679,10.449-10.449c0-5.77-4.679-10.449-10.449-10.449h-97.872v-28.382h97.872c5.77,0,10.449-4.679,10.449-10.449    c0-5.77-4.679-10.449-10.449-10.449h-97.872v-28.382h97.872c5.77,0,10.449-4.679,10.449-10.449c0-5.77-4.679-10.449-10.449-10.449    h-97.872v-28.382h97.872c5.77,0,10.449-4.679,10.449-10.449c0-5.77-4.679-10.449-10.449-10.449h-97.872v-28.681h163.036V491.101z"/>
                                </g>
                            </g>
                        </svg></span>
                       
                    </div>
                </div>
                </div>
<!-- 3 -->
<div class="col-md-5">
    <div class="row">
        <div class="form-group">
            <input type="number" name="turnover" placeholder="Turnover in INR Cr." class="form-control">
            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 477.427 477.427" style="enable-background:new 0 0 477.427 477.427;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M469.5,273.813l-0.2-0.1c-0.2-0.3-0.4-0.6-0.7-0.9c-6.2-7.7-15.3-12.5-25.2-13.5c-9.7-1-19.4,1.9-27,8    c-19.8,16.1-49.9,40.4-67.9,54.9c-13.3,10.8-29.7,16.9-46.7,17.5l-51.1,1.7c-2.1,0.1-4-1-5-2.7l-5.7-9.7c-0.9-1.6-1.1-3.5-0.3-5.2    c0.7-1.7,2.3-2.9,4.1-3.2l52.8-10c18.7-3.4,31.6-21,29.5-40.1c-2.1-18.3-17.6-32.2-36-32.1c-0.5,0-1.1,0-1.8,0l-70.6-2.9    c-28.3-1-52.4,4.4-80.6,18l-37,18c-5.1-10.8-16-17.8-27.9-17.7H31.3c-17,0-31.3,13.7-31.3,30.7v152.1c0,17,14.3,31.1,31.3,31.1    h40.9c17,0,30.8-14.1,30.8-31.1v-10.3l39.3-7.2c12.7-1.9,20.7-2.6,34.2-2.1l107.4,5c2.2,0.1,4.4,0.1,6.6,0.1    c36.4,0,71.6-12.7,99.6-36l74.4-61.7l0.2-0.1C479.6,311.513,481.7,289.213,469.5,273.813z M82.8,436.813c0,6-4.9,10.9-10.9,10.9    H30.6c-6,0-10.9-4.9-10.9-10.9v-152.2c0-6,4.9-10.9,10.9-10.9h41.3c6,0,10.9,4.9,10.9,10.9V436.813z M451.5,309.213l-74.3,61.6    c-25.9,21.5-58.9,32.7-92.6,31.2l-107.4-5c-15.1-0.6-24.3,0.2-38.1,2.3c-0.1,0-0.3,0-0.4,0.1l-35.9,6.6v-113.8l42.8-20.7    c25.1-12.1,46.4-16.9,71.1-16.1l71.1,2.9c0.4,0,0.9,0,1.3,0c0.1,0,0.5,0,0.8,0c9.1,0.1,16.4,7.5,16.3,16.6    c-0.1,7.8-5.7,14.5-13.4,16l-52.8,10c-13.9,2.6-23.1,16-20.5,29.9c0.5,2.9,1.6,5.7,3.1,8.3l5.7,9.8c4.8,8.1,13.6,12.9,23,12.5    l51.1-1.7c21.4-0.7,42-8.4,58.6-21.8c18-14.5,48.2-38.9,68-55c3.5-2.8,7.9-4.1,12.3-3.6c4.4,0.4,8.4,2.5,11.3,5.8    c0.2,0.3,0.4,0.6,0.7,0.9C459.3,293.013,458.4,303.313,451.5,309.213z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M429.5,168.513l-54.4,35.2h-69.3v-24h72.3c2.1-0.1,4.2-0.8,5.9-2.1l56.8-41.1c4.5-3.2,5.5-9.4,2.3-13.9s-9.4-5.5-13.9-2.3    c-0.1,0-0.1,0.1-0.2,0.1l-54.2,39.3h-69v-26h72.3c2.2,0.1,4.4-0.6,6.2-2l56.8-44.8c4.4-3.4,5.1-9.8,1.7-14.1    c-3.4-4.3-9.7-5.1-14.1-1.7l-54.1,42.6h-68.8v-25h72.3c2.5,0.1,4.9-0.8,6.8-2.4l56.8-52.5c4-3.7,4.3-9.9,0.6-13.9    c-1.9-2.1-4.6-3.3-7.4-3.2h-68.4l-0.1-0.4c-1.5-3.9-5.2-6.5-9.3-6.6h-113c-2.6,0.1-5,1.1-6.8,2.9l-4.2,4.1h-71    c-2.5,0-4.9,0.9-6.8,2.6l-56.8,52.6c-3,2.7-4,7-2.5,10.7c1.5,3.8,5.2,6.2,9.3,6.1h67.5v25h-67.5c-5.5,0-10,4.5-10,10    c0,5.5,4.5,10,10,10h67.5v26h-67.5c-5.5,0-10,4.5-10,10s4.5,10,10,10h67.5v24h-67.5c-5.5,0-10,4.5-10,10s4.5,10,10,10h272.8    c1.9,0.1,3.8-0.4,5.5-1.4l56.8-37c4.6-3,5.9-9.1,2.9-13.7C440.3,166.913,434.1,165.513,429.5,168.513z M409.4,36.713l-35.2,32H319    l35-32H409.4z M130.8,68.713l35.3-32h45.6l-35,32H130.8z M285.8,76.913v126.8h-93v-122.5l55.3-51.5h83.6l-42.6,39.7    C287,71.313,285.8,74.013,285.8,76.913z"/>
                    </g>
                </g>
                </svg>
            </span>
         </div>
    </div>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
    <div class="row">
        <div class="form-group">
            <input type="tel" name="phone_number" placeholder="Enter Mobile Number" class="form-control" required>

            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <g>
                            <path d="M384,0H128c-14.138,0-25.6,11.461-25.6,25.6v460.8c0,14.138,11.461,25.6,25.6,25.6h256c14.138,0,25.6-11.461,25.6-25.6     V25.6C409.6,11.461,398.138,0,384,0z M392.533,68.267H196.267c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h196.267     v332.8h-25.6c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h25.6v51.2c0,4.713-3.82,8.533-8.533,8.533H128     c-4.713,0-8.533-3.82-8.533-8.533v-51.2h196.267c4.713,0,8.533-3.82,8.533-8.533s-3.82-8.533-8.533-8.533H119.467v-332.8h25.6     c4.713,0,8.533-3.82,8.533-8.533s-3.82-8.533-8.533-8.533h-25.6V25.6c0-4.713,3.82-8.533,8.533-8.533h256     c4.713,0,8.533,3.82,8.533,8.533V68.267z"/>
                            <path d="M264.533,460.8h-17.067c-4.713,0-8.533,3.82-8.533,8.533s3.82,8.533,8.533,8.533h17.067c4.713,0,8.533-3.82,8.533-8.533     S269.246,460.8,264.533,460.8z"/>
                            <path d="M173.09,139.136l-19.439,11.648c-7.15,4.214-12.389,11.035-14.618,19.029c-7.322,26.701-2.116,72.465,64.299,138.871     c52.582,52.574,92.22,66.782,119.706,66.782c6.472,0.027,12.918-0.814,19.166-2.5c7.988-2.233,14.802-7.471,19.012-14.618     l11.691-19.43c5.023-8.335,2.594-19.148-5.513-24.533l-46.541-30.985c-7.958-5.243-18.606-3.51-24.491,3.985l-13.525,17.391     c-0.323,0.448-0.927,0.59-1.417,0.333l-2.56-1.425c-14.797-8.082-28.142-18.577-39.484-31.053     c-12.475-11.342-22.971-24.687-31.053-39.484l-1.425-2.611c-0.26-0.486-0.118-1.09,0.333-1.408l17.399-13.534     c7.496-5.882,9.222-16.533,3.968-24.482l-30.976-46.473C192.228,136.548,181.426,134.125,173.09,139.136z M183.415,154.112     l16.845,25.276l14.131,21.146c0.331,0.507,0.224,1.182-0.247,1.562l-17.399,13.525c-7.134,5.468-9.163,15.348-4.762,23.185     l1.348,2.475c8.833,16.249,20.314,30.912,33.971,43.383c12.472,13.657,27.134,25.138,43.383,33.971l2.466,1.348     c7.84,4.399,17.721,2.37,23.194-4.762l13.525-17.391c0.374-0.473,1.047-0.584,1.553-0.256l46.455,30.967     c0.518,0.341,0.673,1.032,0.35,1.562l-11.648,19.422c-1.956,3.377-5.142,5.866-8.892,6.946     c-18.313,5.035-58.487,3.942-122.291-59.87c-63.812-63.804-64.922-104.004-59.904-122.291c1.081-3.75,3.57-6.936,6.946-8.892     l19.422-11.648c0.179-0.113,0.386-0.172,0.597-0.171C182.844,153.601,183.202,153.793,183.415,154.112z"/>
                        </g>
                    </g>
                </g>
                </svg>
            </span>
      
        </div>
    </div>
</div>



<!-- 4 -->
            <div class="col-md-5">
            <div class="row">
                <div class="form-group">
                    <input type="text" class="form-control" name="industry_name" required placeholder="Enter Industry Name">
                    <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480 480" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M460.056,209.104c-2.442-1.434-5.46-1.471-7.936-0.096l-22.016,12.232L424,7.776c-0.121-4.331-3.668-7.778-8-7.776h-56    c-4.332-0.002-7.879,3.445-8,7.776L344.544,268.8L320,282.4V216c-0.002-4.418-3.586-7.998-8.004-7.996    c-1.356,0.001-2.69,0.346-3.876,1.004L176,282.4V216c-0.002-4.418-3.586-7.998-8.004-7.996c-1.356,0.001-2.69,0.346-3.876,1.004    l-144,80c-2.541,1.409-4.119,4.086-4.12,6.992v176c0,4.418,3.582,8,8,8h432c4.418,0,8-3.582,8-8V216    C464,213.165,462.5,210.541,460.056,209.104z M367.776,16h40.448l0.464,16H367.32L367.776,16z M366.856,48h42.288l5.2,181.992    L360.8,259.728L366.856,48z M232,464h-48v-40h48V464z M296,464h-48v-40h48V464z M448,464H312v-48c0-4.418-3.582-8-8-8H176    c-4.418,0-8,3.582-8,8v48H32V300.712L160,229.6V296c0.002,4.418,3.586,7.998,8.004,7.996c1.356-0.001,2.69-0.346,3.876-1.004    L304,229.6V296c0.002,4.418,3.586,7.998,8.004,7.996c1.356-0.001,2.69-0.346,3.876-1.004l75.448-41.912L426.4,241.6l21.6-12V464z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M128,320H64c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-32C136,323.582,132.418,320,128,320z     M120,352H72v-16h48V352z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M272,320h-64c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-32C280,323.582,276.418,320,272,320z     M264,352h-48v-16h48V352z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M416,320h-64c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-32C424,323.582,420.418,320,416,320z     M408,352h-48v-16h48V352z"/>
                            </g>
                        </g>
                        </svg>
                    </span>
                                </div>
            </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
            <div class="row">
                <div class="form-group">
                    <select name="name_of_exposure" id="" class="form-control" style="height: 4em;">
                        <option value=''>Exposure</option>
                        <option value='Import'>Import</option>
                        <option value='Export'>Export</option>
                        <option value='Both'>Both</option>
                    </select>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="475.299px" height="475.299px" viewBox="0 0 475.299 475.299" style="enable-background:new 0 0 475.299 475.299;" xml:space="preserve">
                        <g>
                            <path d="M458.159,86.986H169.971c-9.453,0-17.14,7.688-17.14,17.141v75.12H17.141C7.688,179.247,0,186.935,0,196.385v174.783   c0,9.458,7.688,17.145,17.141,17.145h288.185c9.458,0,17.14-7.687,17.14-17.145v-75.119h135.694c9.45,0,17.14-7.684,17.14-17.139   V104.127C475.291,94.674,467.605,86.986,458.159,86.986z M305.656,371.168c0,0.181-0.145,0.334-0.331,0.334l-288.509-0.334   l0.331-175.112l288.509,0.329V371.168z M458.481,278.91c0,0.181-0.146,0.329-0.332,0.329l-135.685-0.153v-82.701   c0-9.45-7.694-17.138-17.145-17.138H169.826l0.141-75.451l288.51,0.331V278.91H458.481z"/>
                        </g>
                        </svg>
                    </span>
              
                </div>
            </div>
            </div>
<!-- 4 -->



  



<!-- btn -->

                    <div class="col-md-12">
                        <div class="g-recaptcha" data-sitekey="6Lc-vLMZAAAAAO5R_0ySg1YnCpnf5F3wJLoAoYqS"></div>
                        <div class="row">
                            <div class="form-group">

                                &nbsp;&nbsp;
                                <button class="frame-btn btn-2" type="submit">
                                 Register
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="frame-btn btn-3" type="reset">
                                  Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</li>
  
	</ul>

</section>


<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $(document).ready(function(){
    
    // Variables
    var clickedTab = $(".tabs > .active");
    var tabWrapper = $(".tab__content");
    var activeTab = tabWrapper.find(".active");
    var activeTabHeight = activeTab.outerHeight();
    
    // Show tab on page load
    activeTab.show();
    
    // Set height of wrapper on page load
    tabWrapper.height(activeTabHeight);
    
    $(".tabs > li").on("click", function() {
        
        // Remove class from active tab
        $(".tabs > li").removeClass("active");
        
        // Add class active to clicked tab
        $(this).addClass("active");
        
        // Update clickedTab variable
        clickedTab = $(".tabs .active");
        
        // fade out active tab
        activeTab.fadeOut(250, function() {
            
            // Remove active class all tabs
            $(".tab__content > li").removeClass("active");
            
            // Get index of clicked tab
            var clickedTabIndex = clickedTab.index();

            // Add class active to corresponding tab
            $(".tab__content > li").eq(clickedTabIndex).addClass("active");
            
            // update new active tab
            activeTab = $(".tab__content > .active");
            
            // Update variable
            activeTabHeight = activeTab.outerHeight();
            
            // Animate height of wrapper to new tab height
            tabWrapper.stop().delay(50).animate({
                height: activeTabHeight
            }, 500, function() {
                
                // Fade in active tab
                activeTab.delay(50).fadeIn(250);
                
            });
        });
    });
});


</script>