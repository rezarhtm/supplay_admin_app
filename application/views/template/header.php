<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Supplay.id | Back Office</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo base_url("public/style.css"); ?>">
	
  <!--<link rel="stylesheet" href="application/views/template/style.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><a href="<?php echo base_url(); ?>index.php/">Supplay.id | Back Office</a></div>
      <ul class="list-group list-group-flush">
        <li><a href="<?php echo base_url(); ?>index.php/vendor/" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Vendor</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/horeka/" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Horeka</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/product/" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Produk</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/category/" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Kategori</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/bank/" aria-expanded="false" class="list-group-item list-group-item-action bg-light">Bank</a></li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Hide Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
-->
        </div>
      </nav>