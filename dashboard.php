<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: loginb.php");
    exit();
}


if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter'] += 1;
}



if (!isset($_SESSION["daftar"])) {
    $_SESSION["daftar"] = [];
}


if (isset($_POST["nama"]) && isset($_POST["umur"])) {
    $daftar = [
        'nama' => $_POST["nama"],
        'umur' => $_POST["umur"],
    ];
    $_SESSION["daftar"][] = $daftar;
    header("Location: dashboard.php");
    exit();
}

$edit_daftar = [
    "nama" => "",
    "umur" => "",
];

$target = "dashboard.php";
if (isset($_GET["index"])) {
    $target = "ubah.php?index=" . $_GET["index"];
    if ($_GET["index"] != null) {
        $index = $_GET["index"];
        $edit_daftar = $_SESSION["daftar"][$index];

    }
}

?>
<html>

<head>
    <title>::Login Page::</title>
    <style type="text/css">
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
        }

        table {
            background-color: white;
            border: 3px solid grey;
            padding: 20px;
            border-radius: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            padding: 5px;
        }

        button {
            background-color: greenyellow;
            padding: 10px;
            border-radius: 5px;
        }

        #logout {
            background-color: red;
        }
    </style>
</head>

<body>
    <h1><?php echo "Selamat datang " . $_SESSION['username'] . " Ke-" . $_SESSION['counter']; ?></h1>
    <form action="<?php echo $target ?>" method="post">
        <table>
            <tr>
                <td colspan="2" style="text-align: center;">DAFTAR</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $edit_daftar["nama"] ?>" /></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><input type="text" name="umur" value="<?php echo $edit_daftar["umur"] ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">PROSES</button>
                    <a href="logout.php">
                        <button type="button" id="logout">LOGOUT</button>
                    </a>

                </td>

            </tr>
        </table>
        <table border="1">
            <tr>
                <td>nama</td>
                <td>Umur</td>
                <td>Keterangan</td>
                <td>Aksi</td>
            </tr>
            <?php foreach ($_SESSION['daftar'] as $index => $daftar): ?>
                <tr>
                    <td><?php echo $daftar['nama']; ?></td>
                    <td><?php echo $daftar['umur']; ?></td>
                    <td>
                        <?php
                        if ($daftar['umur'] <= 10) {
                            echo 'Anak-anak';
                        } elseif ($daftar['umur'] > 10 && $daftar['umur'] <= 20) {
                            echo 'Remaja';
                        } elseif ($daftar['umur'] > 20 && $daftar['umur'] <= 40) {
                            echo 'Dewasa';
                        } else {
                            echo 'Tua';
                        }
                        ?>
                    </td>
                    <td>
                        <a class="btn-hapus" href="hapus.php?index=<?php echo $index ?>"
                            onclick="return confirm('Hapus data?')">hapus</a>
                        <a class="btn-ubah" href="dashboard.php?index=<?php echo $index ?>">ubah</a>
                    </td>
                </tr>


            <?php endforeach; ?>
        </table>
    </form>
</body>

</html>