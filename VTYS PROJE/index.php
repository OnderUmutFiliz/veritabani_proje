<?php include("dist/inc/config.php");
$sonuc="";
if(isset($_GET['sil'])) {
  $sonuc=kaydedildi("danger","Görev (#".$_GET['sil'].") başarıyla silindi.");
}
if(isset($_GET['proje_sil'])) {
  $sonuc=kaydedildi("danger","Proje (#".$_GET['proje_sil'].") başarıyla silindi.");
}
// Kullanıcı sayısı
$result = mysqli_query($mysqli, "SELECT COUNT(*) AS user_count FROM users");
$kullaniciSayisi = mysqli_fetch_assoc($result)['user_count'];

// Kullanıcı sayısı
$result = mysqli_query($mysqli, "SELECT COUNT(*) AS proje_count FROM projeler");
$projeSayisi = mysqli_fetch_assoc($result)['proje_count'];

// Tamamlanan projeler
$result = mysqli_query($mysqli, "SELECT COUNT(id) as total FROM gorevler WHERE durum = 1");
$tamamlananGorevler = mysqli_fetch_assoc($result)['total'];

// Yapım aşamasındaki projeler
$result = mysqli_query($mysqli, "SELECT COUNT(id) as total FROM gorevler WHERE durum = 0 AND end > UNIX_TIMESTAMP()");
$tamamlanacakGorevler = mysqli_fetch_assoc($result)['total'];

// Geciken projeler
$result = mysqli_query($mysqli, "SELECT COUNT(id) as total FROM gorevler WHERE durum = 0 AND end < UNIX_TIMESTAMP()");
$gecikenGorevler = mysqli_fetch_assoc($result)['total'];
?>

      <?php include("header.php"); ?>
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <?php echo $sonuc; ?>
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Anasayfa
                </div>
                <h2 class="page-title">
                  Gösterge Paneli
                </h2>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="fw-bold">
                              Kullanıcı Sayısı
                            </div>
                            <div class="text-muted">
                              <?php echo $kullaniciSayisi; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-pink text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="fw-bold">
                              Proje Sayisi
                            </div>
                            <div class="text-muted">
                              <?php echo $projeSayisi; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="fw-bold">
                              Tamamlanan Görevler
                            </div>
                            <div class="text-muted">
                              <?php echo $tamamlananGorevler; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-info text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="fw-bold">
                              Devam Eden Görevler
                            </div>
                            <div class="text-muted">
                              <?php echo $tamamlanacakGorevler; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-warning text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="fw-bold">
                              Geciken Görevler
                            </div>
                            <div class="text-muted">
                              <?php echo $gecikenGorevler; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
              
              
              
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row justify-content-between gx-0 align-items-center w-100">
                      <div class="col"><h3 class="card-title">Projeler</h3></div>
                      <div class="col-auto ms-auto pe-0">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                          
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                          Yeni Proje
                        </a>
                      </div>
                    </div>
                    
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1 text-center">#</th>
                          <th>Proje Adı</th>
                          <th>Sorumlular</th>
                          <th class="text-center">Başlangıç Tarihi</th>
                          <th class="text-center">Bitiş Tarihi</th>
                          <th class="text-center">Proje Durumu</th>
                          <th class="text-center">Eylem</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                         $secili_db = "projeler";


                          if (isset($_GET['page']) && $_GET['page']!="") {
                            $sayfa_no = $_GET['page'];
                          }
                          else {
                            $sayfa_no = 1;
                          }
                        
                          $sayfabasina_toplam = 10;
                          $offset = ($sayfa_no-1) * $sayfabasina_toplam;
                          $onceki = $sayfa_no - 1;
                          $sonraki = $sayfa_no + 1;
                          $adjacents = "2"; 
                         
                          $sonuc_sayac = mysqli_query($mysqli,"SELECT COUNT(*) As toplam_kayit FROM $secili_db");
                          $toplam_kayit = mysqli_fetch_array($sonuc_sayac);
                          $toplam_kayit = $toplam_kayit['toplam_kayit'];
                          $toplam_sayfa = ceil($toplam_kayit / $sayfabasina_toplam);
                          $second_last = $toplam_sayfa - 1;


                          $result = mysqli_query($mysqli, "SELECT p.*, GROUP_CONCAT(u.id, ' ', u.name, ' ', u.surname, ' ', u.sex, '') AS sorumlu_details
FROM projeler p
LEFT JOIN gorevler g ON p.id = g.proje_id
LEFT JOIN users u ON FIND_IN_SET(u.id, g.sorumlu)
GROUP BY p.id
ORDER BY p.id DESC
LIMIT $offset, $sayfabasina_toplam");
$uniqueUsers = array();
while ($row = mysqli_fetch_array($result)) {
    ?>
                                <tr>
                                    <td><span class="text-muted"><?php echo $row['id'] ?></span></td>
                                    <td><a href="./proje.php?id=<?php echo $row['id']; ?>" class="text-reset fw-semibold" tabindex="-1"><?php echo $row['name'] ?></a></td>
                                    <td>
                                    <?php
   $sorumluDetails = explode(',', $row['sorumlu_details']);
   foreach ($sorumluDetails as $sorumluDetail) {
       $sorumluRow = explode(' ', trim($sorumluDetail));
       $userId = isset($sorumluRow[0]) ? $sorumluRow[0] : null;

       // Kontrol: Bu kullanıcı daha önce eklenmiş mi?
       if (!in_array($userId, $uniqueUsers)) {
           $uniqueUsers[] = $userId; // Kullanıcıyı diziye ekle
           ?>
           <a class="d-inline-block" href="uye.php?id=<?php echo $userId; ?>" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $sorumluRow[1]; ?> <?php echo $sorumluRow[2]; ?>" data-bs-placement="top">
               <img src="./static/avatars/<?php echo $sorumluRow[3]; ?>" class="avatar avatar-sm rounded-circle">
           </a>
           <?php
       }
   }?>
  </td>
                                    <td class="text-center"><div class="row justify-content-center"><div class="col-lg-5"><?php echo date('d.m.Y', $row['start']); ?></div><div class="col-auto fw-bold"><?php echo date('H:i', $row['start']); ?></div></td>
                                    <td class="text-center"><div class="row justify-content-center"><div class="col-lg-5"><?php echo date('d.m.Y', $row['start']); ?></div><div class="col-auto fw-bold"><?php echo date('H:i', $row['end']); ?></div></td>
                                    <td class="text-center"><?php echo status_index($row['status']); ?></td>
                                    <td class="text-center">
                                      <a href="./proje.php?id=<?php echo $row['id'];?>" class="btn btn-outline-primary d-inline p-2 me-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg><small>Düzenle</small></a>
                                      <a href="./proje.php?id=<?php echo $row['id'];?>&sil_onay=1" class="btn btn-outline-danger d-inline p-2 ms-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path></svg></a>
                                    </td>
                                </tr>
                            <?php }
                          ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex align-items-center">
                    
                    <ul class="pagination m-0 ms-auto">
                    <?php 
                    $pages = [];
                    for ($i = 1; $i <= $toplam_sayfa; $i++) {
                      $pages[] = [
                        "number" => $i,
                        "active" => $i == $sayfa_no
                      ];
                    }

                    if ($sayfa_no > 1) {
                      echo '<li class="page-item"><a class="page-link" href="?page=' . $onceki . '">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                      Önceki</a></li>';
                    }
                    foreach ($pages as $page) {
                      echo '<li class="page-item ' . ($page["active"] ? "active" : "") . '"><a class="page-link" href="?page=' . $page["number"] . '">' . $page["number"] . '</a></li>';
                    }
                    if ($sayfa_no < $toplam_sayfa) {
                      echo '<li class="page-item"><a class="page-link" href="?page=' . $sonraki . '">Sonraki 
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                      </a></li>';
                    }
                    
                     ?>
                     </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Formdan gelen verileri al
      $name = $_POST["name"];
      $ekleyen = $_SESSION['username']['id'];
      $start = strtotime($_POST["start"]);
      $end = strtotime($_POST["end"]);
      $content = $_POST["content"];
  
      // Veritabanına ekleme işlemi
      $query = "INSERT INTO projeler (ekleyen, name, start, end, status, content) 
              VALUES ('$ekleyen', '$name', '$start', '$end', '0', '$content')";

      if ($mysqli->query($query)) {
          // Veritabanına başarıyla eklendiyse proje ID'sini al
          $projeID = $mysqli->insert_id;

          // Yönlendirme işlemi
          // header("Location: proje.php?id=$projeID");
          echo '<meta http-equiv="refresh" content="0; url=proje.php?id=' . $projeID . '">';
          exit(); // Yönlendirme yapıldıktan sonra scriptin çalışmasını durdur
      } else {
          echo "Proje oluşturulurken bir hata oluştu: " . $mysqli->error;
      }
  }
  ?>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Yeni Proje Oluştur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Proje Adı</label>
                <input type="text" class="form-control" name="name" required>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Başlangıç Tarihi</label>
                    <input type="datetime-local" name="start" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" name="end" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime(date('Y-m-d\TH:i') . ' +3 day')); ?>" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Detay</label>
                      <textarea id="tinymce-mytextarea" name="content" required>Proje içeriği <b>buraya</b>!</textarea>
                  </div>
                </div>
              </div>

              <div class="bg-azure-lt rounded mt-3 p-2" role="alert">
                <div class="d-flex">
                  <div class="me-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                  </div>
                  <div>
                    Projeyi oluşturulduktan sonra görev ataması yapabilirsiniz.
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                İptal
              </a>
              <button type="submit" class="btn btn-primary ms-auto">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Projeyi Oluştur
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Libs JS -->
    <script src="./dist/libs/tinymce/tinymce.min.js?1684106062" defer></script>
    <script src="./dist/libs/nouislider/dist/nouislider.min.js?1684106062" defer></script>
    <script src="./dist/libs/litepicker/dist/litepicker.js?1684106062" defer></script>
    <script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062" defer></script>
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
    <script>
// @formatter:off
document.addEventListener("DOMContentLoaded", function () {
    var el;
    window.TomSelect && (new TomSelect(el = document.getElementById('sorumlu'), {
        copyClassesToDropdown: false,
        dropdownParent: 'body',
        controlInput: '<input>',
        render:{
            item: function(data,escape) {
                if( data.customProperties ){
                    return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                }
                return '<div>' + escape(data.text) + '</div>';
            },
            option: function(data,escape){
                if( data.customProperties ){
                    return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                }
                return '<div>' + escape(data.text) + '</div>';
            },
        },
    }));
});
// @formatter:on
</script>
    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        let options = {
          selector: '#tinymce-mytextarea',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
          ],
          toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat',
          content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options.skin = 'oxide-dark';
          options.content_css = 'dark';
        }
        tinyMCE.init(options);
      })
      // @formatter:on
    </script>
    <script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	var el;
    	window.TomSelect && (new TomSelect(el = document.getElementById('select-users'), {
    		copyClassesToDropdown: false,
    		dropdownParent: 'body',
    		controlInput: '<input>',
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    		},
    	}));
    });
    // @formatter:on
  </script>
    
    <?php include("footer.php") ?>