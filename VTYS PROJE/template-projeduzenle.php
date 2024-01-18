<?php 
if (isset($_GET['duzenle_onay']) && $_GET['duzenle_onay'] == 1) {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    var modal = new bootstrap.Modal(document.getElementById("p_duzenle"));';
    echo '    modal.show();';
    echo '});';
    echo '</script>';
}
if (isset($_GET['sil_onay']) && $_GET['sil_onay'] == 1) {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    var modal = new bootstrap.Modal(document.getElementById("p_sil"));';
    echo '    modal.show();';
    echo '});';
    echo '</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kaydet"])) {
        // Kaydetme işlemi
        // Form verilerini al ve gorevler tablosuna güncelleme yap
        $projeID = $_GET['id'];
        $name = $_POST['name'];
        $start = strtotime($_POST['start']);
        $end = strtotime($_POST['end']);
        $content = $_POST['content'];
        $status = $_POST['status'];
        // Diğer form verilerini almak için $_POST kullanabilirsiniz
        // Örnek: $projeAdi = $_POST['gorev'];
        
        // SQL güncelleme sorgusu
        $updateQuery = "UPDATE projeler SET name = ?, start = ?, end = ?, content = ?, status = ? WHERE id = ?";

        $stmt = $mysqli->prepare($updateQuery);
        
        $stmt->bind_param("ssssii", $name, $start, $end, $content, $status, $projeID);

        $stmt->execute();
            // $stmt->close();
            echo '<meta http-equiv="refresh" content="0; url=proje.php?id=' . $projeID . '&onay=1">';
            // exit();
    } elseif (isset($_POST["sil"])) {
        // Silme işlemi
        // Gorev silme sorgusu
        echo 'test';
        $projeID = $_GET['id'];
        $deleteQuery = "DELETE FROM projeler WHERE id = ?";
        $stmt = $mysqli->prepare($deleteQuery);
        $stmt->bind_param("i", $projeID);
        $stmt->execute();
        $stmt->close();
        
        // Silme işleminden sonra yönlendirme
        // header("Location: ./proje.php");
        // exit();
        echo '<meta http-equiv="refresh" content="0; url=index.php?proje_sil=' . $projeID . '">';
    }
}

 ?>

<form action="./proje.php?id=<?php echo $projeID ?>" method="POST">

<div class="modal modal-blur fade" id="p_duzenle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Projeyi Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Proje Durumu</label>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="form-selectgroup">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="status" value="1" class="form-selectgroup-input" <?php echo ($proje['status'] == 1) ? 'checked' : ''; ?>>
                                <span class="form-selectgroup-label">
                                    <i class="fas fa-check pe-1"></i>
                                Tamamlandı</span>
                            </label>
                            <label class="form-selectgroup-item">
                                <input type="radio" name="status" value="0" class="form-selectgroup-input" <?php echo ($proje['status'] == 0) ? 'checked' : ''; ?>>
                                <span class="form-selectgroup-label">
                                <i class="fas fa-circle-notch"></i>
                                Devam Ediyor</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
            <label class="form-label">Proje Adı</label>
            <input type="text" class="form-control" name="name" placeholder="Proje adı girin" value="<?php echo $proje['name']; ?>" required>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                <label class="form-label">Başlangıç Tarihi</label>
                <input type="datetime-local" name="start" class="form-control" value="<?php echo date('Y-m-d H:i:s', $proje['start']); ?>" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                <label class="form-label">Bitiş Tarihi</label>
                <input type="datetime-local" name="end" class="form-control" value="<?php echo date('Y-m-d H:i:s', $proje['end']); ?>" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div>
                    <label class="form-label">Detay</label>
                        <textarea id="tinymce-mytextarea" name="content" required><?php echo $proje['content']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        
        
        <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            İptal
            </a>
            <button type="submit" name="kaydet" class="btn btn-primary ms-auto">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg>
            Projeyi Güncelle
            </button>
        </div>
    </div>
    </div>
</div>

</form>
<form action="./proje.php?id=<?php echo $projeID ?>" method="POST">

<div class="modal" id="p_sil" tabindex="-1">
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
            <h3>Projeyi Sileceksin. Emin misin?</h3>
            <div class="text-secondary">(<?php echo '#'.$proje['id'];?>) <?php echo $proje['name']; ?> adlı projeyi silmek istediğine emin misin?</div>
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