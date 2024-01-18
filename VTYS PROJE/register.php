<?php
include_once "dist/inc/config.php";
$sonuc="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // static/avatars içerisinde yer alan 74 adet avatarı kullanabilmek için, 74'e kadar rastgele bir sayı üretip sonuna Erkek ise 'm', kadın ise 'f' ekliyor.
    $sex = $_POST["sex"];
    $randomSex = sprintf("%03d", rand(0, 74));
    $yeniSex = $randomSex . $sex . ".jpg";

    if (empty($name) || empty($surname) || empty($username) || empty($password) || empty($sex)) {
        $sonuc = '<div class="alert alert-danger" role="alert">
                  <h4 class="alert-title">Hata!</h4>
                  <div class="text-secondary">Lütfen tüm alanları doldurun.</div>
              </div>';
    } else {
        // Kullanıcı adını kontrol et
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = $mysqli->query($checkUsernameQuery);

        if ($result->num_rows > 0) {
            $sonuc = '<div class="alert alert-danger" role="alert">
                      <h4 class="alert-title">Hata!</h4>
                      <div class="text-secondary">Bu kullanıcı adı zaten kullanılıyor. Lütfen başka bir kullanıcı adı seçin.</div>
                  </div>';
        } else {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          // Üye kaydını gerçekleştiriyor
          $sql = "INSERT INTO users (username, password, name, surname, sex) VALUES ('$username', '$hashedPassword', '$name', '$surname', '$yeniSex')";

          if ($mysqli->query($sql) === TRUE) {
              // Başarılı ise
              $sonuc = '<div class="alert alert-success" role="alert">
                            <h4 class="alert-title">Tebrikler!</h4>
                            <div class="text-secondary">Hesabınız başarıyla kaydedildi.</div>
                        </div>';
          } else {
              // Veritabanı hatası var ise
              $sonuc = '<div class="alert alert-danger" role="alert">
                            <h4 class="alert-title">Hata!</h4>
                            <div class="text-secondary">Error: ' . $sql . '<br>' . $mysqli->error . '</div>
                        </div>';
          }
        }

        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
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
</head>
<body class="d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="62" alt=""></a>
            </div>
            <?php echo $sonuc; ?>
            <form class="card card-md" action="./register.php" method="post" autocomplete="off" novalidate onsubmit="return validateForm()" name="signupForm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Yeni Hesap Oluştur</h2>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label">Ad</label>
                        <input type="text" class="form-control" name="name" placeholder="Min 3 karakter" minlength="3" maxlength="20" pattern=".{2,}" required>
                      </div>
                      <div class="col">
                        <label class="form-label">Soyad</label>
                        <input type="text" class="form-control" name="surname" placeholder="Min 3 karakter" minlength="3" maxlength="20" pattern=".{2,}" required>
                      </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kullanıcı Adı</label>
                        <div class="input-icon">
                          <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                          </span>
                          <input type="text" name="username" value="" class="form-control" placeholder="Min 4 karakter">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <div class="input-icon input-group input-group-flat">
                            <input type="password" name="password" class="form-control" placeholder="Min 8 karakter" autocomplete="off" required>
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Cinsiyet</div>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" value="m" checked>
                                <span class="form-check-label">Erkek</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" value="f" >
                                <span class="form-check-label">Kadın</span>
                            </label>
                        </div>
                        </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Hesap Oluştur</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Hesabın varmı? <a href="./login.php" tabindex="-1">Giriş Yap</a>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
    
  <script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062" defer></script>
  <script src="./dist/libs/nouislider/dist/nouislider.min.js?1684106062" defer></script>
  <script src="./dist/libs/litepicker/dist/litepicker.js?1684106062" defer></script>
</body>
</html>
