<?php 

$server="localhost";
$user="keremkerem";
$pass="keremkerem";
$db="kerem";

$mysqli = new mysqli($server, $user, $pass, $db);

if($mysqli -> connect_error) {
    die("Baglanti hatasi: " . $mysqli -> connect_error);
}


function status($durum, $zaman) {
    if($durum != 1) {
      if($durum==0 || time() < $zaman) {
        if (time() > $zaman) {
          return '<span class="status status-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
          Gecikti</span>';
        }
        else {
          return '<span class="status status-info">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
          Devamlı</span>';
        }
      }
      else {
        return '<span class="status status-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
        Tamamlandı</span>';
      }
    }
    else {
      return '<span class="status status-success">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
      Tamamlandı</span>';
    }
 
}
function status_index($durum) {
  if($durum==0) {
    return '<span class="status status-info">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
    Devam Ediyor</span>';
  }
  else {
    return '<span class="status status-success">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
    Tamamlandı</span>';
  }
}



function pagination($mysqli, $db, $total_records, $per_page, $current_page, $url)
{
  
if (isset($_GET['sayfa_no']) && $_GET['sayfa_no']!="") {
    $sayfa_no = $_GET['sayfa_no'];
    }
    else {
    $sayfa_no = 1;
    }

    $sayfabasina_toplam = 1;
    $offset = ($sayfa_no-1) * $sayfabasina_toplam;
    $onceki = $sayfa_no - 1;
    $sonraki = $sayfa_no + 1;
    $adjacents = "2"; 
    
    $sonuc_sayac = mysqli_query($mysqli,"SELECT COUNT(*) As toplam_kayit FROM $db");
    $toplam_kayit = mysqli_fetch_array($sonuc_sayac);
    $toplam_kayit = $toplam_kayit['toplam_kayit'];
    $toplam_sayfa = ceil($toplam_kayit / $sayfabasina_toplam);
    $second_last = $toplam_sayfa - 1;

  $pages = [];
  for ($i = 1; $i <= $toplam_sayfa; $i++) {
    $pages[] = [
      "number" => $i,
      "active" => $i == $current_page
    ];
  }

  // Pagination HTML kodunu oluştur
  $html = '<ul class="pagination m-0 ms-auto">';
  if ($current_page > 1) {
    $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $onceki . '">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
    
    Önceki</a></li>';
  }
  foreach ($pages as $page) {
    $html .= '<li class="page-item ' . ($page["active"] ? "active" : "") . '"><a class="page-link" href="' . $url . '?page=' . $page["number"] . '">' . $page["number"] . '</a></li>';
  }
  if ($current_page < $toplam_sayfa) {
    $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $sonraki . '">Sonraki 
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
    
    </a></li>';
  }
  $html .= '</ul>';

  return $html;
}

function turkce_aylar($month) {
  $aylar = array(
      1 => "Ocak",
      2 => "Şubat",
      3 => "Mart",
      4 => "Nisan",
      5 => "Mayıs",
      6 => "Haziran",
      7 => "Temmuz",
      8 => "Ağustos",
      9 => "Eylül",
      10 => "Ekim",
      11 => "Kasım",
      12 => "Aralık"
  );
  return $aylar[$month];
}


function kaydedildi($durum, $text) {
  switch ($durum) {
    case 'success':
      $svg='
      <div>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 12l5 5l10 -10"></path> </svg>
      
      </div>';
      break;
    case 'info':
      $svg='
      <div>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <line x1="12" y1="8" x2="12.01" y2="8"></line> <polyline points="11 12 12 12 12 16 13 16"></polyline> </svg>
      
      </div>';
      break;
    case 'danger':
      $svg='
      <div>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="9"></circle> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line> </svg>
      
      </div>';
      break;
    
    default:
      $svg='';
      break;
  }
  return '<div class="alert alert-'.$durum.' alert-dismissible" role="alert">
  <div class="d-flex">
    '.$svg.'
    <div>
      <div class="text-secondary">'.$text.'</div>
    </div>
  </div>
  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>';
}


function getUserDetails($userId, $mysqli) {
  $userDetailsQuery = "SELECT id, name, surname, sex FROM users WHERE id = ?";
  $userDetailsStmt = $mysqli->prepare($userDetailsQuery);
  $userDetailsStmt->bind_param("i", $userId);
  $userDetailsStmt->execute();
  $userDetailsResult = $userDetailsStmt->get_result();

  if ($userDetailsRow = $userDetailsResult->fetch_assoc()) {
      return $userDetailsRow;
  }

  return null;
}


