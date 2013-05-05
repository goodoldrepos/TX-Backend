<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
  <title></title>
  <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('css/app.css'); ?>" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
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
    <a class="brand" href="#">t a x i</a>
    <ul class="nav pull-right">
      <li >
        <a href="<?php echo site_url('pages/home'); ?>"><i class="icon-home icon-white"></i> Accueil</a>
      </li>     
      <?php if($this->session->userdata('user_id')){ ?>
      <li id="fat-menu" class="dropdown">
        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-plus-sign icon-white"></i> <?php echo $this->session->userdata('username'); ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
          <?php if($this->session->userdata('role') == 'client'){ ?>
          <li>
            <a href="<?php echo site_url('users/update') . '/' . $this->session->userdata('user_id'); ?>"><i class="icon-user"></i> Gestion du compte</a>
          </li>
          <?php }elseif($this->session->userdata('role') == 'chauffeur'){ ?>
            <!--<li>
                  <a href="<?php echo site_url('chauffeurs/update') . '/' . $this->session->userdata('user_id'); ?>"><i class="icon-user"></i> Gestion du compte</a>
              </li>-->
          <?php } ?>
          <?php if(is_admin($this->session->userdata('user_id'))){ ?>
            <li>
              <a href="<?php echo site_url('pages/admin'); ?>"><i class="icon-cog"></i> Panneau d'administration</a>
              <li class="divider"></li>
            </li>
          <?php } ?>
          <li>
            <a href="<?php echo site_url('sessions/destroy'); ?>"><i class="icon-off"></i> Se déconnecter</a>
          </li>

        </ul>
      </li>
      
    <?php }else{ ?>
    <li>
        <a href="<?php echo site_url('pages/chauffeurs') ?>"><i class="icon-road icon-white"></i> Espace Chauffeur</a>
    </li>
    <li>
      <a href="<?php echo site_url('sessions/create'); ?>"><i class="icon-user icon-white"></i> S'identifier</a>
    </li>
    <li  >
      <a href="<?php echo site_url('users/create'); ?>"><i class="icon-plus-sign icon-white"></i> S'inscrire</a>
    </li>
    <?php } ?>
    </ul>
  </div>
</div>







  

  

  
