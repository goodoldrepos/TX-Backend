<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
  <title></title>
  <link href="<?php echo base_url(); ?>css/960.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>css/foundation.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url(); ?>js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>js/foundation.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.foundation.navigation.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.foundation.tabs.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.foundation.alerts.js"></script>
  <script src="<?php echo base_url(); ?>js/maps.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="http://www.paulund.co.uk/playground/demo/gmap-demo/js/gmaps.js"></script>

  <style type="text/css">
  body{
    #margin-top:20px;
  }

  .gray{
    #background-color:green;
    height: 80px;
  }

  .red{
    #background-color:red;
    height: 80px;
  }

  .logo{
    font-family:"aller-bold";
    font-size: 70px;
  }

  .links span{
    margin-right: 50px;
    font-family: "aller-light";
    position:relative;
    top: 40px;
  }
  .void{
    height: 50px;
  }

  .immediat{
    border:black solid 1px;
  }

  </style>
  
</head>
<body class="container">

<nav class="top-bar">
  <ul>
    <li class="name"><h1><a href="#">Taxi.</a></h1></li>
    <li class="toggle-topbar"><a href="#"></a></li>
  </ul>
  <section>
    <ul class="left">
      
      
    </ul>

    <ul class="right">
      <li class="divider hide-for-small"></li>
      <li><a href="<?php echo base_url(); ?>index.php/pages/home">Accueil</a></li>
      <li class="divider hide-for-small"></li>
      <li><a href="<?php echo base_url(); ?>index.php/reservations/home">Réservations</a></li>
      <li class="divider hide-for-small"></li>
      <?php if($this->session->userdata('user_id')){ ?>
		<li>
			<a href="<?php echo base_url(); ?>index.php/sessions/destroy">Se déconnecter</a>
		</li>
			
	  <?php }else{ ?>
		<li>
			<a href="<?php echo base_url(); ?>index.php/sessions/create">Se connecter</a>
		</li>
	  <?php } ?>
    </ul>
  </section>
</nav>


  <script type="text/javascript">
    $(document).foundationNavigation();
  </script>


  

  

  
