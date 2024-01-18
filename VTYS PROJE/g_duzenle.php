<?php 

include_once "dist/inc/config.php";
include("header.php");

if (isset($_GET['sil_onay']) && $_GET['sil_onay'] == 1) {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    var modal = new bootstrap.Modal(document.getElementById("gorevisil"));';
    echo '    modal.show();';
    echo '});';
    echo '</script>';
}


$gorevID = $_GET['id'];

// $gorevSorgu = "SELECT id FROM gorevler WHERE id = $gorevID";
// $gorevSonuc = $mysqli->query($gorevSorgu)->fetch_assoc();
// $gorevID = $gorevSonuc['id'];

$sonuc="";
if (isset($_POST["kaydet"])) $sonuc= kaydedildi('success', 'Değişiklikler kaydedildi.');
if (isset($_POST["sil"])) $sonuc= kaydedildi('danger', 'Silindi');
if (isset($_POST["ekle"])) $sonuc= kaydedildi('primary', 'İçerik eklendi');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kaydet"])) {
        // Kaydetme işlemi
        // Form verilerini al ve gorevler tablosuna güncelleme yap
        $gorevID = $_GET['id'];
        $start = strtotime($_POST['start']);
        $end = strtotime($_POST['end']);
        // Diğer form verilerini almak için $_POST kullanabilirsiniz
        // Örnek: $gorevAdi = $_POST['gorev'];
        
        // SQL güncelleme sorgusu
        $updateQuery = "UPDATE gorevler SET gorev = ?, start = ?, end = ?, sorumlu = ?, durum = ? WHERE id = ?";

        $stmt = $mysqli->prepare($updateQuery);
        
        // Örnek olarak sadece görev alanını güncelliyorum, diğer alanları da uygun şekilde ekleyin
        $sorumluImploded = implode(',', $_POST['sorumlu']);
        $stmt->bind_param("ssssii", $_POST['gorev'], $start, $end, $sorumluImploded, $_POST['durum'], $gorevID);

        $stmt->execute();
            // $stmt->close();
            // echo '<meta http-equiv="refresh" content="0; url=g_duzenle.php?id=' . $gorevID . '">';
            // exit();
    } elseif (isset($_POST["sil"])) {
        // Silme işlemi
        // Gorev silme sorgusu
        echo 'test';
        $gorevID = $_GET['id'];
        $deleteQuery = "DELETE FROM gorevler WHERE id = ?";
        $stmt = $mysqli->prepare($deleteQuery);
        $stmt->bind_param("i", $gorevID);
        $stmt->execute();
        $stmt->close();
        
        // Silme işleminden sonra yönlendirme
        // header("Location: ./proje.php");
        // exit();
        echo '<meta http-equiv="refresh" content="0; url=index.php?sil=' . $gorevID . '">';
    }
}
?>
<div class="page-wrapper">

<?php if (isset($_GET['id'])) {
    $gorevID = $_GET['id'];

    // Veritabanından projenin ayrıntılarını al
    $gorevSorgu = "SELECT * FROM gorevler WHERE id = $gorevID";
    $gorevSonuc = $mysqli->query($gorevSorgu);

    if ($gorevSonuc->num_rows > 0) {
        $gorev = $gorevSonuc->fetch_assoc();

        // Sorumluın ID'lerini al
        $sorumluIDler = explode(',', $gorev['sorumlu']);

        // Sorumluın adı ve soyadını bul
        $sorumluAdSoyad = array();
        foreach ($sorumluIDler as $sorumluID) {
            $sorumluSorgu = "SELECT * FROM users WHERE id = $sorumluID";
            $sorumluSonuc = $mysqli->query($sorumluSorgu);

            if ($sorumluSonuc->num_rows > 0) {
                $sorumlu = $sorumluSonuc->fetch_assoc();
                $sorumluAdSoyad[] = '<a href="user.php?id=' . $sorumlu['id'] . '" class="text-reset d-block mt-2"><div class="row"><div class="col-auto"><span class="avatar rounded" style="background-image: url(./static/avatars/'.$sorumlu['sex'].')"></span></div><div class="col"><span class="fw-bold d-block">'. $sorumlu['name'] . '</span>' . $sorumlu['surname'] . '</div></div></a>';
            }
        }
?>

    <form action="./g_duzenle.php?id=<?php echo $gorevID ?>" method="POST">

        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">

            <?php if($sonuc) echo $sonuc; ?>

                <div class="row g-2 align-items-center">
                    <div class="col-12 col-lg">
                        <!-- Page pre-title -->
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="./proje.php?id=<?php echo $gorev['proje_id'];?>">Proje Sayfası</a></li>
                            <li class="breadcrumb-item" aria-current="page">Görev (#<?php echo $gorev['id']; ?>)</li>
                            <li class="breadcrumb-item active"><a href="./proje.php">Düzenle</a></li>
                        </ol>
                        <h2 class="page-title">
                            Görev Sayfası
                        </h2>
                        
                    </div>
                    
                    <!-- Page title Eylemler -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">

                            <a class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#gorevisil">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" /></svg>
                                Sil
                            </a>
                            <a class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#gorevisil" aria-label="Yeni Proje">

                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" /></svg>
                            </a>

                            <button type="submit" name="kaydet" class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                Kaydet
                            </button>
                            <button type="submit" name="kaydet" class="btn btn-primary d-sm-none btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                

                <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Görevler</h3>
                </div>
                <div class="card-table table-responsive">
                    <?php
                    $gorevID = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    // Veritabanından görevleri çek
                    $query = "SELECT g.*, u.name as sorumlu_name, u.surname as sorumlu_surname, u.sex as sorumlu_avatar 
                                FROM gorevler g
                                JOIN users u ON g.sorumlu = u.id
                                WHERE g.id = ?";
                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param("i", $gorevID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) :
                    ?>
                
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="row w-100 p-3">
                            <div class="col-12 mb-3">
                                <div class="datagrid-title mb-2">Görev Durumu</div>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="durum" value="1" class="form-selectgroup-input" <?php echo ($row['durum'] == 1) ? 'checked' : ''; ?>>
                                                <span class="form-selectgroup-label">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                                Tamamlandı</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="durum" value="0" class="form-selectgroup-input" <?php echo ($row['durum'] == 0) ? 'checked' : ''; ?>>
                                                <span class="form-selectgroup-label">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-dashed me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" /><path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" /><path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" /><path d="M8.56 20.31a9 9 0 0 0 3.44 .69" /><path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" /><path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" /><path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" /><path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" /></svg>
                                                Devam Ediyor</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="small text-secondary"><i class="fas fa-info-circle"></i> Bitiş süresi geçen görevler otomatik <span class="status status-warning mx-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>Gecikti</span> olarak işaretlenir.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="datagrid-title mb-2">Görev</div>
                                <div class="text-secondary text-truncate mt-n1">
                                    <textarea id="tinymce-mytextarea" name="gorev" novalidate><?php echo $row['gorev']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="datagrid-title mb-2">Sorumlular</div>
                                <?php
                                $selectedSorumluIDs = explode(',', $row['sorumlu']);

                                // Tüm kullanıcıları al
                                $userQuery = "SELECT id, name, surname FROM users";
                                $userStmt = $mysqli->prepare($userQuery);
                                $userStmt->execute();
                                $userResult = $userStmt->get_result();

                                echo '<select type="text" class="form-control w-auto" name="sorumlu[]" id="sorumlu" value="" multiple>';

                                while ($userRow = $userResult->fetch_assoc()) {
                                    $selected = in_array($userRow['id'], $selectedSorumluIDs) ? 'selected' : '';
                                    echo '<option value="' . $userRow['id'] . '" ' . $selected . '>' . $userRow['name'] . ' ' . $userRow['surname'] . '</option>';
                                }

                                echo '</select>';

                                $userStmt->close();
                                ?>
                            </div>
                            
                            
                            <div class="col-12 col-md-6 mb-3">
                                <div class="datagrid-title mb-2">Başlangıç Tarihi</div>
                                <input type="datetime-local" name="start" class="form-control" value="<?php echo date('Y-m-d\TH:i', $gorev['start']); ?>" required>
                                


                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div class="datagrid-title mb-2">Bitiş Tarihi</div>
                                <input type="datetime-local" name="end" class="form-control" value="<?php echo date('Y-m-d\TH:i', $gorev['end']); ?>" required>

                            </div>
                            
                    <?php } ?>
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

        <div class="modal" id="gorevisil" tabindex="-1">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Emin misin?</h3>
                    <div class="text-secondary"><?php echo '#'.$gorev['id'];?> numaralı görevi silmek istediğine emin misin?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                            İptal Et
                        </a></div>
                        <div class="col">
                            <button type="submit" name="sil" class="btn btn-danger w-100 btn-sil" >
                            Sil
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </form>
    <?php
    } else {
            echo '<p>Görev bulunamadı.</p>';
        }
    } else {
        echo '<p>Görev ID belirtilmedi.</p>';
    }
    ?>


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