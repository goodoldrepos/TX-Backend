<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
  <title></title>
  <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('css/app.css'); ?>" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
  <script src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
  <script src="<?php echo base_url('js/maps.js'); ?>"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="<?php echo base_url('js/gmaps.js'); ?>"></script>
  <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <style type="text/css">

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
<body>

  <div id="wrap">

  <div class="navbar navbar-static-top navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="#">Beta.</a>
    <ul class="nav pull-right">
      <li><a href="<?php echo site_url('pages/home'); ?>">Accueil</a></li>
      <li>
        <a href="<?php echo site_url('pages/services'); ?>">Services</a>
      </li>
      <li>
        <a href="<?php echo site_url('pages/tarifs'); ?>">Tarifs</a>
      </li>      
      <?php if($this->session->userdata('user_id')){ ?>
      <li>
        <a href="<?php echo site_url('users/update') . '/' . $this->session->userdata('user_id'); ?>">Profil</a>
      </li>
      <li>
       <a href="<?php echo site_url('sessions/destroy'); ?>">Déconnexion</a>
      </li>
      
    <?php }else{ ?>
    <li>
        <a href="<?php echo site_url('pages/chaffeurs') ?>">Espace Chaffeurs</a>
    </li>
    <li  >
      <a href="<?php echo site_url('sessions/create'); ?>">Connexion</a>
    </li>
    <?php } ?>
    </ul>
  </div>
</div>







  

  

  
