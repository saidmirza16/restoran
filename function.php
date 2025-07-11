<?php


$koneksi = mysqli_connect("localhost", "root", "", "restoran");

function register_admin()

{

    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);

    $password = md5(htmlspecialchars($_POST["password"]));

    $email = htmlspecialchars($_POST["email"]);

    $no_hp = htmlspecialchars($_POST["no_hp"]);

    $cek_username = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `admin` WHERE username = '$username'"));


    if ($cek_username != null) {

        echo "<script>

            alert('Username sudah ada!');

        </script>";

        return -1;
    } 

    mysqli_query($koneksi, "INSERT INTO `admin`

                            VALUES ('', '$username', '$password', '$email', '$no_hp')

    ");

    return mysqli_affected_rows($koneksi);


}


// Funtion Register

function register_akun()

{

    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);

    $password = md5(htmlspecialchars($_POST["password"]));

    $email = htmlspecialchars($_POST["email"]);

    $no_hp = htmlspecialchars($_POST["no_hp"]);

    $cek_username = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `user` WHERE username = '$username'"));


    if ($cek_username != null) {

        echo "<script>

            alert('Username sudah ada!');

        </script>";

        return -1;
    } 

    mysqli_query($koneksi, "INSERT INTO `user`

                            VALUES ('', '$username', '$password', '$email', '$no_hp')

    ");

    return mysqli_affected_rows($koneksi);
}



// Function Login

function login_admin()

{

    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);

    $password = md5(htmlspecialchars($_POST["password"]));

    $cek_akun_admin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `admin` 

                                                           WHERE username = '$username' AND 

                                                                `password` = '$password'

    "));

    if ($cek_akun_admin != null) {

        $_SESSION["akun-admin"] = [

            "username" => $username,

            "password" => $password

        ];

        header("Location: ../index.php");
    }

        echo "<script>
        alert('Username atau password salah!');
    </script>";
    return -1; 

}

function login_user()

{

    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);

    $password = md5(htmlspecialchars($_POST["password"]));


    $cek_akun_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `user` 

                                                           WHERE username = '$username' AND 

                                                                `password` = '$password'

    "));


    if ($cek_akun_user != null) {

        $_SESSION["akun-user"] = [

            "username" => $username,

            "password" => $password

        ];

        header("Location: index.php");
    }

    echo "<script>
        alert('Username atau password salah!');
    </script>";
    return -1; 

}



// Function Select Data

function ambil_data($query)

{

    global $koneksi;



    $db = [];

    $sql_query = mysqli_query($koneksi, $query);

    while ($q = mysqli_fetch_assoc($sql_query)) {

        array_push($db, $q);
    }

    return $db;
}



// Function Tambah Data

function tambah_data_menu()

{

    global $koneksi;



    $nama = htmlspecialchars($_POST["nama"]);

    $harga = (int) htmlspecialchars($_POST["harga"]);

    $gambar = htmlspecialchars($_FILES["gambar"]["name"]);

    $kategori = htmlspecialchars($_POST["kategori"]);

    $status = htmlspecialchars($_POST["status"]);



    // Generate Kode Menu

    $kode_menu = "MN" . ambil_data("SELECT MAX(SUBSTR(kode_menu, 3)) AS kode FROM menu")[0]["kode"] + 1;



    // cek format gambar

    $format_gambar = ["jpg", "jpeg", "png", "gif"];

    $cek_gambar = explode(".", $gambar);

    $cek_gambar = strtolower(end($cek_gambar));

    if (!in_array($cek_gambar, $format_gambar)) {

        echo "<script>

            alert('File yang diupload bukan merupakan image!');

        </script>";

        return -1;
    }



    // upload file
    $nama_gambar = uniqid() . ".$cek_gambar";
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "src/img/$nama_gambar");


    $kode_admin = fetch_data_admin();

    // eksekusi query insert

    $id_menu = ambil_data("SELECT MAX(SUBSTR(kode_menu, 3)) AS kode FROM menu")[0]["kode"] + 1;

    mysqli_query($koneksi, "INSERT INTO menu

                            VALUES ('$id_menu', '$kode_admin', '$kode_menu', '$nama', $harga, '$nama_gambar', '$kategori', '$status')

    ");

    return mysqli_affected_rows($koneksi);
}



// Function Edit Data Menu

function edit_data_menu()

{

    global $koneksi;



    $id_menu = $_POST["id_menu"];

    $nama = htmlspecialchars($_POST["nama"]);

    $harga = (int) htmlspecialchars($_POST["harga"]);

    $gambar = htmlspecialchars($_FILES["gambar"]["name"]);

    $kategori = htmlspecialchars($_POST["kategori"]);

    $status = htmlspecialchars($_POST["status"]);

    $kode_menu = htmlspecialchars($_POST["kode_menu"]);



    // cek format gambar

    $format_gambar = ["jpg", "jpeg", "png", "gif"];

    $cek_gambar = explode(".", $gambar);

    $cek_gambar = strtolower(end($cek_gambar));

    if (!in_array($cek_gambar, $format_gambar) && strlen($gambar) != 0) {

        echo "<script>

            alert('File yang diupload bukan merupakan image!');

        </script>";

        return -1;
    }



    // cek jika admin mengupload gambar yang baru

    $gambar_lama = $_POST["gambar-lama"];



    if (strlen($gambar) == 0) {

        $gambar = $gambar_lama;
    } else if ($gambar != $gambar_lama && strlen($gambar) != 0) {

        move_uploaded_file($_FILES["gambar"]["tmp_name"], "src/img/$gambar");

        unlink("src/img/$gambar_lama");
    }



    // eksekusi query update

    mysqli_query($koneksi, "UPDATE menu

                            SET kode_menu = '$kode_menu',

                                nama = '$nama',

                                harga = $harga,

                                gambar = '$gambar',

                                kategori = '$kategori',

                                `status` = '$status'

                            WHERE id_menu = $id_menu

    ");

    return mysqli_affected_rows($koneksi);
}



// Function Hapus Data Menu

function hapus_data_menu()

{

    global $koneksi;



    $id_menu = $_GET["id_menu"];



    // hapus file gambar

    $file_gambar = ambil_data("SELECT * FROM menu WHERE id_menu = $id_menu")[0]["gambar"];

    unlink("src/img/$file_gambar");



    // eksekusi query delete

    mysqli_query($koneksi, "DELETE FROM menu

                            WHERE id_menu = $id_menu

    ");

    return mysqli_affected_rows($koneksi);
}

function fetch_data_user()
{
    if (!isset($_SESSION['akun-user']['username'])) {
        return null;
    }
    $result = ambil_data("SELECT * FROM user WHERE username = '{$_SESSION['akun-user']['username']}'");
    if (empty($result) || !isset($result[0])) {
        return null;
    }
    $user = $result[0];
    $kode_user = $user["id_user"];
    return $kode_user;
}

function fetch_data_admin()
{
    $result = ambil_data("SELECT * FROM `admin` WHERE username = '{$_SESSION['akun-admin']['username']}'");
    if (empty($result) || !isset($result[0])) {
        return null;
    }
    $user = $result[0];
    $kode_user = $user["id_admin"];
    return $kode_user;
}



// Tambah Data Pesanan & Transaksi

function tambah_data_pesanan()

{

    global $koneksi;

    // Nama Pelanggan

    $pelanggan = htmlspecialchars($_POST["pelanggan"]);

    // Mengambil Data Qty dan Kode Menu

    $list_pesanan = [];

    $kode_user = fetch_data_user();    

    $max_menu = count(ambil_data("SELECT * FROM menu"));

    for ($i = 1; $i <= $max_menu; $i++) {

        if ((int) $_POST["qty$i"] != 0) {

            array_push($list_pesanan, [

                "id_menu" => $_POST["id_menu$i"],

                "kode_menu" => $_POST["kode_menu$i"],

                "qty" => (int) $_POST["qty$i"]

            ]);
        }
    }


    // Cek Jika Memesan Tapi Kosong
    if (count($list_pesanan) == 0) {
        echo "<script>
            alert('Anda belum memesan menu!');
        </script>";
        return -1;
    }

      // Generate Kode Pesanan
            $kode_pesanan = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 12);


// Tambah Data Transaksi
mysqli_query($koneksi, "INSERT INTO transaksi (kode_pesanan, nama_pelanggan, tanggal_transaksi, total)
VALUES ('$kode_pesanan', '$pelanggan', NOW(), 0)");

// Ambil tanggal_transaksi yang baru saja dimasukkan
$tanggal_transaksi = null;
$result = mysqli_query($koneksi, "SELECT tanggal_transaksi FROM transaksi WHERE kode_pesanan = '$kode_pesanan' LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    $tanggal_transaksi = $row['tanggal_transaksi'];
}

    
    

    // Tambah Data Pesanan
        foreach ($list_pesanan as $lp) {
            $kode_menu = $lp["kode_menu"];
            $id_menu = $lp["id_menu"];
            $qty = $lp["qty"];
            

        
            // Ambil nama menu dan tanggal berdasarkan kode_menu
            $menu = ambil_data("SELECT nama FROM menu WHERE kode_menu = '$kode_menu'");
            $nama_menu = isset($menu[0]['nama']) ? $menu[0]['nama'] : '';

            // Ambil tanggal transaksi dari tabel transaksi
            $transaksi = ambil_data("SELECT tanggal_transaksi FROM transaksi WHERE kode_pesanan = '$kode_pesanan'");
            $tanggal_transaksi = isset($transaksi[0]['tanggal_transaksi']) ? $transaksi[0]['tanggal_transaksi'] : date('Y-m-d H:i:s');

            $query = "INSERT INTO pesanan (nama_pelanggan, nama_menu, kode_pesanan, kode_menu, qty, tanggal_pesanan)
                      VALUES ('$pelanggan', '$nama_menu', '$kode_pesanan', '$kode_menu', '$qty', '$tanggal_transaksi')";

            if (!mysqli_query($koneksi, $query)) {
                die("Gagal insert pesanan: " . mysqli_error($koneksi));
            }
        }

return mysqli_affected_rows($koneksi);

}






// Hapus Data Pesanan & Transaksix

function hapus_data_pesanan()

{

    global $koneksi;



    $kode_pesanan = $_GET["kode_pesanan"];

    // eksekusi query delete

    mysqli_query($koneksi, "DELETE FROM transaksi

                            WHERE kode_pesanan = '$kode_pesanan'

    ");

    mysqli_query($koneksi, "DELETE FROM pesanan

                            WHERE kode_pesanan = '$kode_pesanan'

    ");

    return mysqli_affected_rows($koneksi);
}