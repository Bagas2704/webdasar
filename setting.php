<?php
session_start();

// Jika pengguna belum login, tendang ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: loginb.php"); // Pastikan nama file login Anda benar
    exit();
}

// --- Logika untuk Flash Message (Alert sekali pakai) ---
$flash_message = "";
if (isset($_SESSION['flash_message'])) {
    $flash_message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']); // Hapus pesan agar tidak muncul lagi
}

// --- Inisialisasi data user dari session jika belum ada ---
if (!isset($_SESSION['user_data'])) {
    $_SESSION['user_data'] = [
        'username' => $username,
        'password' => $password
    ];
}
$user_saat_ini = $_SESSION['user_data'];


// --- Proses Form Saat Tombol "Submit" Ditekan ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data baru dari form
    $username_baru = $_POST['username'];
    $password_baru = $_POST['password'];

    // Update data di dalam session
    $_SESSION['user_data']['username'] = $username_baru;
    $_SESSION['user_data']['password'] = $password_baru;

    // Juga update session username utama untuk konsistensi
    $_SESSION['username'] = $username_baru;

    // Buat pesan flash untuk ditampilkan setelah redirect
    $_SESSION['flash_message'] = "Update telah berhasil";

    // Redirect kembali ke halaman ini untuk mencegah form dikirim ulang
    header("Location: setting.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="dashboardb.css" rel="stylesheet">
    <style>
        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }
    </style>
</head>

<body>


    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark"> <a
            class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Company name</a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap"> <button class="nav-link px-3 text-white" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch"
                    aria-expanded="false" aria-label="Toggle search"> <svg class="bi" aria-hidden="true">
                        <use xlink:href="#search"></use>
                    </svg> </button> </li>
            <li class="nav-item text-nowrap"> <button class="nav-link px-3 text-white" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation"> <svg class="bi" aria-hidden="true">
                        <use xlink:href="#list"></use>
                    </svg> </button> </li>
        </ul>
        <div id="navbarSearch" class="navbar-search w-100 collapse"> <input
                class="form-co  ntrol w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5> <button type="button"
                            class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active"
                                    aria-current="page" href="dashboardboots.php"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Dashboard
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#file-earmark"></use>
                                    </svg>
                                    Orders
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    Products
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#people"></use>
                                    </svg>
                                    Customers
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#graph-up"></use>
                                    </svg>
                                    Reports
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#puzzle"></use>
                                    </svg>
                                    Integrations
                                </a> </li>
                        </ul>
                        <h6
                            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                            <span>Saved reports</span> <a class="link-secondary" href="#" aria-label="Add a new report">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#plus-circle"></use>
                                </svg> </a>
                        </h6>
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#file-earmark-text"></use>
                                    </svg>
                                    Current month
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#file-earmark-text"></use>
                                    </svg>
                                    Last quarter
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#file-earmark-text"></use>
                                    </svg>
                                    Social engagement
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="#"> <svg
                                        class="bi" aria-hidden="true">
                                        <use xlink:href="#file-earmark-text"></use>
                                    </svg>
                                    Year-end sale
                                </a> </li>
                        </ul>
                        <hr class="my-3">
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2"
                                    href="setting.php"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#gear-wide-connected"></use>
                                    </svg>
                                    Settings
                                </a> </li>
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2" href="logout.php">
                                    <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#door-closed"></use>
                                    </svg>
                                    Sign out
                                </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- KONTEN UTAMA HALAMAN SETTING -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Setting</h1>
                </div>

                <div class="col-lg-8">

                    <?php if (!empty($flash_message)): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($flash_message); ?>
                        </div>
                    <?php endif; ?>


                    <form method="POST" action="setting.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?php echo htmlspecialchars($user_saat_ini['username']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>

                            <input type="text" class="form-control" id="password" name="password"
                                value="<?php echo htmlspecialchars($user_saat_ini['password']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="house-fill" viewBox="0 0 16 16">
            <path
                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
        </symbol>
        <symbol id="gear-wide-connected" viewBox="0 0 16 16">
            <path
                d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z" />
        </symbol>
        <symbol id="door-closed" viewBox="0 0 16 16">
            <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z" />
            <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z" />
        </symbol>
    </svg>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>