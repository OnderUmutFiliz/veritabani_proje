<?php
include_once "dist/inc/config.php";
session_start();
if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $password = "";
$sonuc = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $sonuc = '<div class="alert alert-danger" role="alert">
                      <h4 class="alert-title">Hata!</h4>
                      <div class="text-secondary">Kullanıcı adı ve şifre boş bırakılamaz.</div>
                  </div>';
    } else {
        $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = $mysqli->query($checkUserQuery);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user;

                $sonuc = '<div class="alert alert-success" role="alert">
                              <h4 class="alert-title">Başarılı!</h4>
                              <div class="text-secondary">Giriş yapıldı. Yönlendiriliyorsunuz...</div>
                          </div>';
                header("refresh:1;url=index.php");
                exit();
            } else {
                $sonuc = '<div class="alert alert-danger" role="alert">
                              <h4 class="alert-title">Hata!</h4>
                              <div class="text-secondary">Kullanıcı adı veya şifre yanlış.</div>
                          </div>';
            }
        } else {
            $sonuc = '<div class="alert alert-danger" role="alert">
                          <h4 class="alert-title">Hata!</h4>
                          <div class="text-secondary">Kullanıcı bulunamadı.</div>
                      </div>';
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
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
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="62" alt=""></a>
        </div>
        <?php echo $sonuc; ?>

        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Hesaba Giriş Yap</h2>
            <form action="" method="post" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Şifre
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" name="password" class="form-control"  autocomplete="off">
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Şifreyi Göster" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                  </span>
                </div>
              </div>
              <div class="mb-2">
                <label class="form-check">
                  <input type="checkbox" class="form-check-input"/>
                  <span class="form-check-label">Beni Hatırla</span>
                </label>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
              </div>
            </form>

          </div>
          
         
        </div>
        <div class="text-center text-muted mt-3">
          Hesabın Yokmu? <a href="./register.php" tabindex="-1">Kayıt Ol</a>
        </div>
        

        <div class="text-center text-muted mt-3">
          <a href="#" class="text text-primary text-center" data-bs-toggle="modal" data-bs-target="#modal-scrollable">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg> Kullanıcı şifreleri
          </a>
        </div>

      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>

    <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kullanıcılar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <?php
            // Kullanıcıları seç
$result = mysqli_query($mysqli, "SELECT * FROM users");


// Verileri ekrana yazdır
echo "<table class='table table-vcenter'>
<thead>
<tr>
<th>ID</th>
<th>Kullanıcı Adı</th>
<th>Şifre</th>
<th>Ad ve Soyad</th>
</tr>
</thead>";

while($row = mysqli_fetch_array($result))
{
  if($row['password'] == '$2y$10$zUC31Sdv4aoyyqMSaG5mVe.dA8ep7svQ0mjEW8A24C6MsVxzzSDiW') {
    $row['password'] = '12345';
  }
  elseif($row['password'] == '$2y$10$c0ZIYnrxT0j/lZpx2b9RnOP8r8Hr5WLmJRzmtbiEs4bVTWDRrEV.O') {
    $row['password'] = 'admin';
  }
  
  else {
    $row['password'] = 'Farklı şifre';
  }
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td class='fw-semibold'>" . $row['username'] . "</td>";
    echo "<td class='fw-semibold'>" . $row['password'] . "</td>";
    echo "<td>" . $row['name'] . " " . $row['surname'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Sorguyu serbest bırak
mysqli_free_result($result);

// Bağlantıyı kapat
mysqli_close($mysqli);
?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kapat</button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>