<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if( isset($_POST["ekle"])) {
    $projeID = $_GET['id'];
    $ekleyen = $_SESSION['username']['id'];
    $gorev = $_POST["gorev"];
    $start = strtotime($_POST["start"]);
    $end = strtotime($_POST["end"]);

    // Sorumluları bir dizi olarak al
    $sorumluArray = $_POST["sorumlu"];
    if (!is_array($sorumluArray)) {
        $sorumluArray = [$sorumluArray];
    }
    $sorumlu = implode(",", $sorumluArray);

    $query = "INSERT INTO gorevler (proje_id, ekleyen, sorumlu, gorev, start, end) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    
    $stmt->bind_param("iissss", $projeID, $ekleyen, $sorumlu, $gorev, $start, $end);



if ($stmt->execute()) {
    echo '<meta http-equiv="refresh" content="0; url=proje.php?id=' . $projeID . '">';
    exit();
} else {
    echo "Görev oluşturulurken bir hata oluştu: " . $stmt->error;
}


    // Bağlantıyı kapat
    $stmt->close();
    $mysqli->close();
}
} ?>
<form action="./proje.php?id=<?php echo $_GET['id']?>" method="POST">
<div class="modal modal-blur fade" id="gorevekle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Yeni Görev</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            <label class="form-label">Atanacak Sorumlu</label>
            <div class="mb-3">
            <?php 
            // Oturum açılmışsa, mevcut kullanıcı ID'sini al
            $currentUserID = isset($_SESSION['username']['id']) ? $_SESSION['username']['id'] : null;
        
            // Veritabanından tüm kullanıcıları al
            $query = "SELECT id, name, surname FROM users";
            $stmt = $mysqli->prepare($query);
            
            // Bu parametre, mevcut oturum açılmışsa, oturum açan kullanıcının ID'sini içerir
            // Eğer oturum açılmamışsa, bu parametre NULL olacaktır
            // $stmt->bind_param("i", $currentUserID);
        
            // Sorguyu çalıştır
            $stmt->execute();
            $result = $stmt->get_result();
        
            $options = '';
            while ($row = $result->fetch_assoc()) {
                $options .= '<option value="' . $row['id'] . '">' . $row['name'] . ' ' . $row['surname'] . '</option>';
            }
            $htmlyazdir = '<select type="text" class="form-control w-auto" name="sorumlu[]" id="sorumlu" value="" multiple><option value="" selected disabled>Kullanıcı seçin</option>' . $options . '</select>';
            echo $htmlyazdir;

            ?>
            <span class="form-check-description mt-2">Çoklu kullanıcı seçimi yapılabilir.</span>
            </div>
            <div class="mb-3">
            <label class="form-label">Görev İçeriği</label>
            <textarea id="tinymce-mytextarea" name="gorev" required>Görev içeriği <b>buraya</b>!</textarea>
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
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            İptal
            </a>
            <button name="ekle" type="submit" class="btn btn-success ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
            Görevi Ekle
            </button>
        </div>
    </div>
    </div>
</div>
</form>


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
