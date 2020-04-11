<?php 
    include "koneksi.php";

    $query2 = mysqli_query($connect, "SELECT MAX(id) AS id FROM `data`");

    $getMaxID = mysqli_fetch_array($query2);

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $satuan = $_POST['satuan'];
        $kategori = $_POST['kategori'];
        $gambar = $_POST['urlgambar'];
        $stok = $_POST['stok'];

        $sql = "INSERT INTO `data`(`id`, `nama`, `harga`, `satuan`, `kategori`, `gambar`, `stok`) VALUES (null, '$nama',$harga,'$satuan','$kategori','$gambar',$stok)";

        mysqli_query($connect, $sql);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Form Input</title>
</head>
<style>
    th,td {
        padding: 10px;
    }
</style>
<body>
    <center>
    <table border="2">
        <form action="" method="post">
        <tr>
            <h1><center>Form Input Master dan Stock Data Barang</center></h1>
        </tr>
        <tr>
            <th>Kode Produk</th>
            <td><input type="text" value="<?= ($getMaxID['id']+1) ?>" disabled></td>
            <input type="hidden" name="id" value="<?= ($getMaxID['id']+1) ?>">
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td>
                <input type="text" name="nama" id="">
            </td>
        </tr>
        <tr>
            <th>Harga Produk</th>
            <td>
                <input type="number" name="harga">
            </td>
        </tr>
        <tr>
            <th>Satuan</th>
            <td>
                <select name="satuan" id="" style="width: 182px">
                    <option value="">Satuan</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Pack">Kg</option>
                    <option value="Pack">Liter</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>
                <select name="kategori" id="" style="width: 182px">
                    <option value="">Kategori</option>
                    <option value="Baju">Makanan</option>
                    <option value="Celana">Minuman</option>
                    <option value="Sepatu">Sepatu</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>URL Gambar</th>
            <td>
                <input type="url" name="urlgambar" id="">
            </td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>
                <input type="number" name="stok" id="">
            </td>
        </tr>
        <tr>
            <th>
                <input type="submit" value="Simpan" name="submit" style="width: 100px">
            </th>
            <td>
                Data akan tampil dibawah
            </td>
        </tr>
        </form>
    </table>
    </center>
    <br>
    <table border="1" cellspacing="0" style="width: 100%;" >
        <tr class="table-primary" style="text-align: center;" >
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Satuan</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
        <?php 
        $query = mysqli_query($connect, "SELECT * FROM `data`");
        foreach ($query as $data) :
        ?>
        <tr>
            <td><center><?= $data['id'] ?></center></td>
            <td><center><?= $data['nama'] ?></center></td>
            <td><center><?= $data['harga'] ?></center></td>
            <td><center><?= $data['satuan'] ?></center></td>
            <td><center><?= $data['kategori'] ?></center></td>
            <td><center><img src="<?= $data['gambar'] ?>" alt="" width="100px" height="100px"></center></td>
            <td <?php if($data['stok'] <= 5) : ?> style="background-color: red; color: white" <?php endif; ?> ><?=$data['stok'] ?></td>
            <td><center><a href="delete.php?id=<?= $data['id'] ?>">Delete</a></center></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>