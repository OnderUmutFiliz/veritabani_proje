<?php 

include_once "dist/inc/config.php";
include("header.php");

$sonuc="";
if (isset($_POST["kaydet"]) || isset($_GET['onay']) == 1) $sonuc= kaydedildi('success', 'Değişiklikler kaydedildi.');
if (isset($_POST["sil"])) $sonuc= kaydedildi('danger', 'Silindi');
if (isset($_POST["ekle"])) $sonuc= kaydedildi('success', 'Görev eklendi');
?>
<div class="page-wrapper">

<?php if (isset($_GET['id'])) {
    $projeID = $_GET['id'];

    // Veritabanından projenin ayrıntılarını al
    $projeSorgu = "SELECT p.*, u.id as ekleyen_id, u.name as ekleyen_name, u.surname as ekleyen_surname, u.sex as ekleyen_sex
               FROM projeler p
               JOIN users u ON p.ekleyen = u.id
               WHERE p.id = $projeID";
    $projeSonuc = $mysqli->query($projeSorgu);

    if ($projeSonuc->num_rows > 0) {
        $proje = $projeSonuc->fetch_assoc();

        
?>


    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
          
        <?php if($sonuc) echo $sonuc; ?>
            <div class="row g-2 align-items-center">
                <div class="col-12 col-lg">
                    <!-- Page pre-title -->
                    <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="./index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="./proje.php?id=<?php echo $proje['id'];?>">Proje Sayfası</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $proje['name']; ?></a></li>
                    </ol>
                    <h2 class="page-title">
                        Proje Sayfası
                    </h2>
                </div>
                
                <!-- Page title Eylemler -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                      <a href="#" class="btn btn-success d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#gorevekle">
                            <svg xm<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                            Görev Ekle
                        </a>
                        <a href="#" class="btn btn-success d-sm-none" data-bs-toggle="modal"
                            data-bs-target="#gorevekle" aria-label="Yeni Proje">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                            Görev Ekle
                        </a>

                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#p_duzenle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            Düzenle
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none" data-bs-toggle="modal"
                            data-bs-target="#p_duzenle" aria-label="Yeni Proje">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            Düzenle
                        </a>

                        <a href="#" class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#p_sil">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h16" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                            Sil
                        </a>
                        <a href="#" class="btn btn-danger d-sm-none" data-bs-toggle="modal"
                            data-bs-target="#p_sil" aria-label="Yeni Proje">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h16" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                            Sil
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-lg">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Proje Hakkında</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid-item mb-3">
                                <div class="datagrid-title mb-2">Proje Adı</div>
                                <div class="datagrid-content fs-3 fw-semibold"><?php echo $proje['name']; ?></div>
                            </div>
                            <div class="datagrid-item my-3">
                                <div class="datagrid-title mb-2">Projeyi Durumu</div>
                                <div class="datagrid-content">
                                    <div class="align-items-center">
                                    <?php echo status_index($proje['status']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col-md-auto">
                                    <div class="datagrid-item mb-3">
                                        <div class="datagrid-title mb-2">Başlangıç Tarihi</div>
                                        <div class="datagrid-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path> <path d="M16 3v4"></path> <path d="M8 3v4"></path> <path d="M4 11h16"></path> <path d="M11 15h1"></path> <path d="M12 15v3"></path> </svg>
                                            <?php echo date('d.m.Y H:i', $proje['start']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="datagrid-item mb-3">
                                        <div class="datagrid-title mb-2">Bitiş Tarihi</div>
                                        <div class="datagrid-content">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path> <path d="M16 3v4"></path> <path d="M8 3v4"></path> <path d="M4 11h16"></path> <path d="M11 15h1"></path> <path d="M12 15v3"></path> </svg>
                                            <?php echo date('d.m.Y H:i', $proje['end']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Projeyi Başlatan</div>
                                <div class="datagrid-content">
                                    <div class="align-items-center">
                                        <?php echo '<a href="uye.php?id=' . $proje['ekleyen_id'] . '" class="text-reset d-inline-block mt-2"><div class="row"><div class="col-auto"><span class="avatar rounded" style="background-image: url(./static/avatars/'.$proje['ekleyen_sex'].')"></span></div><div class="col"><span class="fw-bold d-block">'. $proje['ekleyen_name'] . '</span>' . $proje['ekleyen_surname'] . '</div></div></a>'; ?>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg mt-3 mt-lg-0">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Proje İçeriği</h3>
                        </div>
                        <div class="card-body">

                            <div class="datagrid-item my-3">
                                <div class="datagrid-content">
                                <?php echo $proje['content']; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>




            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Görevler</h3>
              </div>
              <div class="card-table table-responsive">
                <?php
                  $projeID = isset($_GET['id']) ? intval($_GET['id']) : 0;

                  // Veritabanından görevleri çek
                  $query = "SELECT g.*, u.name as sorumlu_name, u.surname as sorumlu_surname, u.sex as sorumlu_avatar 
                            FROM gorevler g
                            JOIN users u ON g.sorumlu = u.id
                            WHERE g.proje_id = ?
                            ORDER BY id DESC";
                  $stmt = $mysqli->prepare($query);
                  $stmt->bind_param("i", $projeID);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  if ($result->num_rows > 0) :
                ?>
                <table class="table table-vcenter">
                  <thead>
                    <tr>
                      <th>Sorumlular            </th>
                      <th>Görev</th>
                      <th class="text-center">Durum</th>
                      <th class="text-center">Başlangıç</th>
                      <th class="text-center">Bitiş</th>
                      <th class="text-center" colspan="2">Eylem</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                      <tr>
                          
                          <td>
                            <?php /* <span class='fw-bold'><?php echo $row['sorumlu_name']; ?></span> <?php echo $row['sorumlu_surname']; ?> */ ?>
                            <?php
                            $row['sorumlu'] = explode(',', $row['sorumlu']);
                        if (is_array($row['sorumlu'])) {
                            foreach ($row['sorumlu'] as $sorumluID) {
                                // Her bir sorumlu için ayrı ayrı kullanıcı bilgilerini al
                                $sorumluQuery = "SELECT id, name, surname, sex FROM users WHERE id = ?";
                                $sorumluStmt = $mysqli->prepare($sorumluQuery);
                                $sorumluStmt->bind_param("i", $sorumluID);
                                $sorumluStmt->execute();
                                $sorumluResult = $sorumluStmt->get_result();

                                if ($sorumluRow = $sorumluResult->fetch_assoc()) { ?>
                                    <a class="d-inline-block" href="uye.php?id=<?php echo $sorumluRow['id'] ?>" data-bs-toggle="tooltip" data-bs-html="true" title="<span class='fw-bold'><?php echo $sorumluRow['name']; ?></span> <?php echo $sorumluRow['surname']; ?>" data-bs-placement="top" ><img src="./static/avatars/<?php echo $sorumluRow['sex']; ?>" class="avatar avatar-sm rounded-circle"></a>
                                    
                                <?php }

                                $sorumluStmt->close();
                            }
                        } else {
                            // Eğer "sorumlu" bir dizi değilse
                            echo "Sorumlu: " . $row['sorumlu_name'] . ' ' . $row['sorumlu_surname'] . "<br>";
                        }
                        ?>
                              
                          </td>
                          
                          <td class="td-truncate">
                              <div class="text-truncate">
                                  <div class="text-secondary text-truncate mt-n1">
                                      <?php echo str_replace(['<p>', '</p>'], '', $row['gorev']); ?> (#<?php echo $row['id']; ?>)
                                  </div>
                              </div>
                          </td>
                          <td class="text-center ">
                            <?php echo status($row['durum'], $row['end']) ?>
                          </td>
                          <td class="text-nowrap text-secondary"><?php echo date("d.m.Y H:i", $row['start']); ?></td>
                          <td class="text-nowrap text-secondary"><?php echo date("d.m.Y H:i", $row['end']); ?></td>
                          <td>
                            <a href="./g_duzenle.php?id=<?php echo $row['id'];?>" class="btn btn-outline-primary btn-sm d-inline me-2">Düzenle</a><a href="./g_duzenle.php?id=<?php echo $row['id'];?>&sil_onay=1" class="btn btn-outline-danger btn-sm d-inline">Sil</a>
                        </td>
                      </tr>
                  <?php } ?>

                  </tbody>
                </table>











                <?php else : ?>
                  <div class="empty">
                    <div class="empty-img"><img src="./static/illustrations/undraw_sign_2in_e6hj.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">Görev yok</p>
                    <p class="empty-subtitle text-secondary">
                      Projeye henüz görev ataması yapılmamış.
                    </p>
                    <div class="empty-action">
                    <a href="#" class="btn btn-success d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#gorevekle">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                        Görev ekle
                      </a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>


            </div>
          </div>



            
        </div>
    </div>
    <?php
    } else {
            echo '<p>Proje bulunamadı.</p>';
        }
    } else {
        echo '<p>Proje ID belirtilmedi.</p>';
    }
    ?>

    <?php include("template-projeduzenle.php") ?>


    <?php include("g_ekle.php") ?>

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
    

    <?php include("footer.php") ?>