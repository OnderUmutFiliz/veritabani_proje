<?php
include_once "dist/inc/config.php";
include("header.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getTaskTotals($userId)
{
    global $mysqli;

    // Sorumlu Olduğu Projeler
    $sorumluQuery = "SELECT COUNT(DISTINCT g.proje_id) as total FROM gorevler g WHERE FIND_IN_SET($userId, g.sorumlu)";
    $sorumluResult = $mysqli->query($sorumluQuery);
    $sorumluTotal = $sorumluResult->fetch_assoc()['total'];

    // Tamamlanan Görevler
    $tamamlananQuery = "SELECT COUNT(id) as total FROM gorevler WHERE durum = 1 AND FIND_IN_SET($userId, sorumlu)";
    $tamamlananResult = $mysqli->query($tamamlananQuery);
    $tamamlananTotal = $tamamlananResult->fetch_assoc()['total'];

    // Tamamlanacak Görevler
    $tamamlanacakQuery = "SELECT COUNT(id) as total FROM gorevler WHERE durum = 0 AND end > UNIX_TIMESTAMP() AND FIND_IN_SET($userId, sorumlu)";
    $tamamlanacakResult = $mysqli->query($tamamlanacakQuery);
    $tamamlanacakTotal = $tamamlanacakResult->fetch_assoc()['total'];

    // Geciken Görevler
    $gecikenQuery = "SELECT COUNT(id) as total FROM gorevler WHERE durum = 0 AND end < UNIX_TIMESTAMP() AND FIND_IN_SET($userId, sorumlu)";
    $gecikenResult = $mysqli->query($gecikenQuery);
    $gecikenTotal = $gecikenResult->fetch_assoc()['total'];

    return [
        'sorumlu' => $sorumluTotal,
        'tamamlanan' => $tamamlananTotal,
        'tamamlanacak' => $tamamlanacakTotal,
        'geciken' => $gecikenTotal
    ];
}

function listProjects($query, $title, $badgeClass, $showTasks = true, $showFwSemibold = true)
{
    global $mysqli;
    
    echo '<div class="card my-3">
        <div class="card-header">
            <h3 class="card-title"><span class="badge badge-lg ' . $badgeClass . ' me-2"></span>' . ($showFwSemibold ? '<span class="fw-semibold">' : '') . $title . ($showFwSemibold ? '</span>' : '') . '</h3>
        </div>
        <div class="list-group list-group-flush">';

    $result = $mysqli->query($query);

if (!$result) {
    die("Error in query: " . $mysqli->error . ". Query: " . $query);
}


    while ($row = $result->fetch_assoc()) {
        echo '<a href="./proje.php?id=' . $row['id'] . '" class="list-group-item list-group-item-action">' . ($showFwSemibold ? '<span class="fw-semibold">' : '') . $row['name'] . ($showFwSemibold ? '</span>' : '');

        // Görevler varsa, parantez içinde listele
        if ($showTasks && !empty($row['gorev'])) {
            $tasks = explode(',', $row['gorev']);
            echo '<div class="text-muted small">Görev #' . implode('<br>Görev #', array_map('trim', str_replace(['<p>', '</p>'], '', $tasks))) . '</div>';
        }
        

        echo '</a>';
    }

    echo '</div></div>';

    
}

$userId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$userId) {
    $userQuery = "SELECT name, surname, sex FROM users";
} else {
    $userQuery = "SELECT name, surname, sex FROM users WHERE id = $userId";
}

$userResult = $mysqli->query($userQuery);
$userData = $userResult->fetch_assoc();

$taskTotals = $userId ? getTaskTotals($userId) : null;
?>

<div class="page-wrapper">

  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col-12 col-lg">
            <!-- Page pre-title -->
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="./index.php">Anasayfa</a></li>
                    <li class="breadcrumb-item"><a href="./uye.php">Üyeler</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (isset($_GET['id'])) {
                        echo $userData['name'] . ' ' . $userData['surname'];
                    } else {
                        echo 'Tüm Üyeler';
                    }
                    ?>
                </li>
            </ol>
            <h2 class="page-title">
                Üye Sayfası
            </h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">

    <?php if($userId > 0 ) : ?>
      <div class="row">

        <div class="col">

          <?php
          if (isset($_GET['id'])) {
          ?>
          <div class="card my-3">
            <div class="card-body">
              <div class="row justify-content-center align-items-center border-bottom mb-3 pb-3">
                <div class="col-auto">
                  <span class="avatar rounded"
                    style="background-image: url(./static/avatars/<?php echo $userData['sex']; ?>)"></span>
                </div>
                <div class="col">
                  <h3 class="mb-0 fw-normal"><span
                      class="fw-semibold"><?php echo $userData['name'] . '</span> ' . $userData['surname']; ?></h3>
                </div>
              </div>

              <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                  <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                  <path d="M12 12l0 .01"></path>
                  <path d="M3 13a20 20 0 0 0 18 0"></path>
                  <path d="M12 7v5l3 3"></path>
                </svg>
                Sorumlu Olduğu Projeler: <strong><?php echo $taskTotals['sorumlu']; ?></strong>
              </div>
              <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                  <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                  <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                  <path d="M11 6l9 0" />
                  <path d="M11 12l9 0" />
                  <path d="M11 18l9 0" /></svg>
                Tamamlanan Görevler: <strong><?php echo $taskTotals['tamamlanan']; ?></strong>
              </div>
              <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                  <path d="M16 3v4"></path>
                  <path d="M8 3v4"></path>
                  <path d="M4 11h16"></path>
                  <path d="M11 15h1"></path>
                  <path d="M12 15v3"></path>
                </svg>
                Tamamlanacak Görevler: <strong><?php echo $taskTotals['tamamlanacak']; ?></strong>
              </div>
              <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                  <path d="M12 7v5l3 3"></path>
                </svg>
                Geciken Görevler: <strong><?php echo $taskTotals['geciken']; ?></strong>
              </div>
            </div>
          </div>
          <?php } ?>

              <?php if (isset($_GET['id'])) {
                // Sorumlu olduğu projeleri al
                $query = "SELECT g.id, GROUP_CONCAT(CONCAT(g.id, ': ', g.gorev)) AS gorev, p.id, p.name
                FROM gorevler g
                INNER JOIN projeler p ON g.proje_id = p.id
                WHERE FIND_IN_SET(" . $_GET['id'] . ", g.sorumlu)
                GROUP BY g.id, p.id, p.name";
                listProjects($query, 'Sorumlu Olduğu Projeler', 'bg-primary', false, false);
                
              while ($userData = $userResult->fetch_assoc()) {
              ?>
              <div class="col-6 col-md-4 col-lg-3 mb-3">
                <a href="./uye.php?id=<?php echo $userData['id']; ?>" class="text-reset text-decoration-none">
                  <div class="card">
                    <div class="card-body text-center">
                      <div class="avatar avatar-lg mb-2">
                        <span class="avatar-title rounded-circle bg-light">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                        </span>
                      </div>
                      <div class="fw-semibold"><?php echo $userData['name'] . ' ' . $userData['surname']; ?></div>
                    </div>
                  </div>
                </a>
              </div>
              <?php } ?>
        </div>

        <div class="col-12 col-md-9">
          <?php

              // Tamamlanan projeleri al
              $query = "SELECT MIN(g.id) AS id, GROUP_CONCAT(CONCAT(g.id, ': ', g.gorev)) AS gorev, p.id, p.name
              FROM gorevler g
              INNER JOIN projeler p ON g.proje_id = p.id
              WHERE g.durum = 1 AND FIND_IN_SET(" . $_GET['id'] . ", g.sorumlu)
              GROUP BY p.id, p.name";
              listProjects($query, 'Tamamlanan Görevler', 'bg-success');
              

              // Tamamlanacak projeleri al
              $query = "SELECT MIN(g.id) AS id, GROUP_CONCAT(CONCAT(g.id, ': ', g.gorev)) AS gorev, p.id, p.name
              FROM gorevler g
              INNER JOIN projeler p ON g.proje_id = p.id
              WHERE g.durum = 0 AND g.end > UNIX_TIMESTAMP() AND FIND_IN_SET(" . $_GET['id'] . ", g.sorumlu)
              GROUP BY p.id, p.name";
              listProjects($query, 'Tamamlanacak Görevler', 'bg-info');

              // Geciken projeleri al
              $query = "SELECT MIN(g.id) AS id, GROUP_CONCAT(CONCAT(g.id, ': ', g.gorev)) AS gorev, p.id, p.name
              FROM gorevler g
              INNER JOIN projeler p ON g.proje_id = p.id
              WHERE g.durum = 0 AND g.end < UNIX_TIMESTAMP() AND FIND_IN_SET(" . $_GET['id'] . ", g.sorumlu)
              GROUP BY p.id, p.name";
              listProjects($query, 'Geciken Görevler', 'bg-warning');
          }
          ?>
        </div>

      </div>

    </div>
    <?php else: ?>
      <div class="row">
        <?php 
        $userQuery = "SELECT id, name, surname, sex FROM users";
        $userResult = $mysqli->query($userQuery);
        while ($row = $userResult->fetch_assoc()) : ?>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <span class="avatar avatar-xl rounded" style="background-image: url(./static/avatars/<?php echo $row['sex']; ?>)"></span>
                        </div>
                        <div class="card-title mb-1"><?php echo $row['name'] . ' ' . $row['surname']; ?></div>
                        <div class="text-secondary">User ID: <?php echo $row['id']; ?></div>
                    </div>
                    <a href="./uye.php?id=<?php echo $row['id']; ?>" class="card-btn">Profili Görüntüle</a>
                </div>
            </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>

  <script src="./dist/libs/tinymce/tinymce.min.js?1684106062" defer></script>
  <script src="./dist/libs/nouislider/dist/nouislider.min.js?1684106062" defer></script>
  <script src="./dist/libs/litepicker/dist/litepicker.js?1684106062" defer></script>
  <script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062" defer></script>
  <script src="./dist/js/tabler.min.js?1684106062" defer></script>
  <script src="./dist/js/demo.min.js?1684106062" defer></script>
  <?php include("footer.php") ?>
