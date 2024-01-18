<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Logout logic
if(isset($_GET['logout'])) {
    session_destroy();

    header("Location: login.php");
    exit();
} ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Gösterge Paneli</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->

<header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="./index.php" style="width:30px;height:44px">
              <svg class="rounded w-100" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" viewBox="0 0 198 268" enable-background="new 0 0 198 268" xml:space="preserve"> <path fill="#1F75D8" opacity="1.000000" stroke="none" d=" M123.000000,269.000000 C82.021736,269.000000 41.543472,269.000000 1.032603,269.000000 C1.032603,179.736359 1.032603,90.472694 1.032603,1.104518 C66.894753,1.104518 132.789734,1.104518 198.842346,1.104518 C198.842346,90.333107 198.842346,179.666534 198.842346,269.000000 C173.806259,269.000000 148.653137,269.000000 123.000000,269.000000 M127.915985,199.576767 C131.604767,202.948166 135.126358,206.530106 139.030396,209.630478 C142.770325,212.600555 148.031311,212.129120 150.919937,209.100342 C153.968094,205.904327 153.918381,200.538132 150.734879,196.792084 C149.876678,195.782227 148.836731,194.924576 147.862885,194.015640 C135.439331,182.420258 122.979492,170.863174 110.644501,159.174362 C109.564735,158.151154 109.299133,156.268768 108.655365,154.785461 C110.171173,154.157455 111.678001,153.012222 113.204262,152.985703 C122.865059,152.817902 132.530960,152.972961 142.193527,152.868179 C148.159378,152.803482 152.196869,149.071655 152.175690,143.973846 C152.155731,139.171722 148.207947,135.395859 142.541290,135.154892 C137.885254,134.956924 133.213074,135.146561 128.548050,135.150955 C121.451691,135.157639 114.355324,135.152710 107.234421,135.152710 C107.234421,132.387390 107.234421,130.275391 107.234421,128.020340 C120.597626,125.831551 130.387573,119.329460 134.441528,106.021530 C136.922043,97.878769 137.004547,89.549171 134.748688,81.366531 C132.798294,74.291931 129.275604,68.092720 122.413727,64.547379 C119.455055,63.018715 116.150444,62.190514 113.860992,65.419937 C111.694595,68.475792 112.303612,71.589783 114.842041,74.498306 C117.568512,77.622269 120.444374,80.760605 122.437721,84.346947 C125.720299,90.252831 125.816757,96.565208 122.045113,102.384560 C118.403290,108.003609 112.847198,110.137535 105.627083,110.194397 C105.627083,107.929253 105.646667,105.982201 105.623810,104.035652 C105.500572,93.544098 105.686371,83.035873 105.136353,72.566467 C104.690155,64.073410 100.631714,61.259174 92.130211,62.421837 C77.777977,64.384628 67.358658,75.049812 66.016113,89.152168 C64.274376,107.447708 71.759727,120.802765 86.704788,125.970520 C89.030548,126.774727 91.429375,127.367615 93.780296,128.054108 C93.780296,130.431198 93.780296,132.541672 93.780296,134.971817 C91.969803,135.057938 90.350029,135.203094 88.730453,135.200851 C78.733856,135.187027 68.736885,135.069168 58.740879,135.128647 C51.955532,135.169006 47.393436,139.114456 47.486042,144.578796 C47.578186,150.015930 51.732002,153.211151 58.709610,153.128342 C68.038811,153.017593 77.367729,152.770981 86.695984,152.803772 C88.216171,152.809097 89.732346,153.954620 91.250374,154.573151 C90.571861,156.188126 90.313347,158.245331 89.150215,159.350037 C76.828491,171.052597 64.359688,182.600250 51.942299,194.202240 C50.849934,195.222839 49.706543,196.228317 48.807266,197.408737 C46.090977,200.974197 46.116852,205.963028 48.948837,208.907654 C52.182655,212.270172 56.059692,212.289246 59.927887,210.257294 C61.657413,209.348785 63.130417,207.886383 64.585152,206.530807 C75.311516,196.535431 85.998924,186.498245 96.714668,176.491425 C97.768829,175.507019 98.931099,174.638367 100.192421,173.592209 C109.432152,182.250473 118.417747,190.670609 127.915985,199.576767 z"></path> <path fill="#FBFDFE" opacity="1.000000" stroke="none" d=" M127.659668,199.333755 C118.417747,190.670609 109.432152,182.250473 100.192421,173.592209 C98.931099,174.638367 97.768829,175.507019 96.714668,176.491425 C85.998924,186.498245 75.311516,196.535431 64.585152,206.530807 C63.130417,207.886383 61.657413,209.348785 59.927887,210.257294 C56.059692,212.289246 52.182655,212.270172 48.948837,208.907654 C46.116852,205.963028 46.090977,200.974197 48.807266,197.408737 C49.706543,196.228317 50.849934,195.222839 51.942299,194.202240 C64.359688,182.600250 76.828491,171.052597 89.150215,159.350037 C90.313347,158.245331 90.571861,156.188126 91.250374,154.573151 C89.732346,153.954620 88.216171,152.809097 86.695984,152.803772 C77.367729,152.770981 68.038811,153.017593 58.709610,153.128342 C51.732002,153.211151 47.578186,150.015930 47.486042,144.578796 C47.393436,139.114456 51.955532,135.169006 58.740879,135.128647 C68.736885,135.069168 78.733856,135.187027 88.730453,135.200851 C90.350029,135.203094 91.969803,135.057938 93.780296,134.971817 C93.780296,132.541672 93.780296,130.431198 93.780296,128.054108 C91.429375,127.367615 89.030548,126.774727 86.704788,125.970520 C71.759727,120.802765 64.274376,107.447708 66.016113,89.152168 C67.358658,75.049812 77.777977,64.384628 92.130211,62.421837 C100.631714,61.259174 104.690155,64.073410 105.136353,72.566467 C105.686371,83.035873 105.500572,93.544098 105.623810,104.035652 C105.646667,105.982201 105.627083,107.929253 105.627083,110.194397 C112.847198,110.137535 118.403290,108.003609 122.045113,102.384560 C125.816757,96.565208 125.720299,90.252831 122.437721,84.346947 C120.444374,80.760605 117.568512,77.622269 114.842041,74.498306 C112.303612,71.589783 111.694595,68.475792 113.860992,65.419937 C116.150444,62.190514 119.455055,63.018715 122.413727,64.547379 C129.275604,68.092720 132.798294,74.291931 134.748688,81.366531 C137.004547,89.549171 136.922043,97.878769 134.441528,106.021530 C130.387573,119.329460 120.597626,125.831551 107.234421,128.020340 C107.234421,130.275391 107.234421,132.387390 107.234421,135.152710 C114.355324,135.152710 121.451691,135.157639 128.548050,135.150955 C133.213074,135.146561 137.885254,134.956924 142.541290,135.154892 C148.207947,135.395859 152.155731,139.171722 152.175690,143.973846 C152.196869,149.071655 148.159378,152.803482 142.193527,152.868179 C132.530960,152.972961 122.865059,152.817902 113.204262,152.985703 C111.678001,153.012222 110.171173,154.157455 108.655365,154.785461 C109.299133,156.268768 109.564735,158.151154 110.644501,159.174362 C122.979492,170.863174 135.439331,182.420258 147.862885,194.015640 C148.836731,194.924576 149.876678,195.782227 150.734879,196.792084 C153.918381,200.538132 153.968094,205.904327 150.919937,209.100342 C148.031311,212.129120 142.770325,212.600555 139.030396,209.630478 C135.126358,206.530106 131.604767,202.948166 127.659668,199.333755 M78.080482,92.867668 C78.008026,103.795929 85.392021,110.998657 95.148209,109.525146 C95.148209,99.509651 95.148209,89.494156 95.148209,79.466789 C85.133125,80.021477 80.725502,83.357674 78.080482,92.867668 z"></path> <path fill="#2A7CDA" opacity="1.000000" stroke="none" d=" M78.128799,92.455498 C80.725502,83.357674 85.133125,80.021477 95.148209,79.466789 C95.148209,89.494156 95.148209,99.509651 95.154503,109.526909 C85.392021,110.998657 78.008026,103.795929 78.128799,92.455498 z"></path> </svg>
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link hide-theme-dark" title="Gece Modunu Aç" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link hide-theme-light" title="Gündüz Modunu Aç" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./static/avatars/<?php echo $_SESSION['username']['sex'] ?>)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo '<span class="fw-semibold">'. $_SESSION['username']['name'] . '</span>'; ?></div>
                  <div class="mt-1 small text-muted"><?php echo $_SESSION['username']['surname'] ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="./uye.php?id=<?php echo $_SESSION['username']['id'] ?>" class="dropdown-item">Profil</a>
                <a href="./uye.php?id=<?php echo $_SESSION['username']['id'] ?>" class="dropdown-item">Görevlerim</a>
                <div class="dropdown-divider my-0"></div>
                <a href="?logout" class="dropdown-item">Çıkış Yap</a>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="./" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Ansayfa
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./uye.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Üyeler
                    </span>
                  </a>
                </li>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Yardım
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                      Dokumantasyon
                    </a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>


