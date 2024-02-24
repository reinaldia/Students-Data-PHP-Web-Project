<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghazi XI RPL 2</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .navbar {
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar:nth-of-type(2) {
            top: 56px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        #cardsContainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-gap: 15px;
        }

        #cardsContainer .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            height: 500px;
            overflow: hidden;
        }

        #cardsContainer .card:hover {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #cardsContainer .card img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            height: 200px;
            object-fit: cover;
        }

        #cardsContainer .card-body {
            padding: 20px;
            height: calc(100% - 200px);
            overflow-y: auto;
        }

        #cardsContainer .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #cardsContainer .card-text {
            margin-bottom: 5px;
        }

        .divDelete,
        .divEdit {
            width: 100%;
            padding: 0.5rem 2rem;
            border: 1.5px solid lightskyblue;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        .divDelete a,
        .divEdit a {
            text-decoration: none;
        }

        .divDelete {
            border-radius: 0 0 0.5rem 0;
        }

        .divEdit {
            border-radius: 0 0 0 0.5rem;
        }

        .divDelete:hover,
        .divEdit:hover {
            background-color: lightskyblue;
        }


        .sorting-dropdown {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 0.4rem;
        }

        .sorting-dropdown {
            margin-right: 10px;
        }

        .sorting-link a {
            cursor: pointer;
            transition: color 0.3s;
            margin: 0 0.4rem;
            text-decoration: none;
            color: black;
        }

        .sorting-link:hover a {
            color: blue;
        }

        .nav-link:hover {
            color: red !important;
        }

        .navbar-collapse {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            flex-grow: 1;
        }

        .navbar-nav {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .form-inline {
            width: auto;
            display: inline-block;
        }

        .all-center {
            justify-content: center;
            align-items: center;
        }

        .btn-logout {
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-logout:hover {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ghazi XI RPL 2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0 mx-auto" action="index.php" method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?= isset($search) ? $search : '' ?>">
            </form>
            <a class="btn btn-logout">Logout</a>
        </div>
    </nav>

    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin logout dari akun ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto all-center">
                <div class="sorting-dropdown">
                    <span>Sorting:</span>
                    <select class="form-control sorting-dropdown-menu" onchange="location = this.value;">
                        <option value="" selected disabled hidden>Choose...</option>
                        <option value="index.php?sort=nis" <?= isset($_GET['sort']) && $_GET['sort'] == 'nis' ? 'selected' : '' ?>>NIS</option>
                        <option value="index.php?sort=nama_lengkap" <?= isset($_GET['sort']) && $_GET['sort'] == 'nama_lengkap' ? 'selected' : '' ?>>Nama Lengkap</option>
                        <option value="index.php?sort=nama_kelas" <?= isset($_GET['sort']) && $_GET['sort'] == 'nama_kelas' ? 'selected' : '' ?>>Kelas</option>
                        <option value="index.php?sort=golongan_darah" <?= isset($_GET['sort']) && $_GET['sort'] == 'golongan_darah' ? 'selected' : '' ?>>Golongan Darah</option>
                        <option value="index.php?sort=nama_ibu_kandung" <?= isset($_GET['sort']) && $_GET['sort'] == 'nama_ibu_kandung' ? 'selected' : '' ?>>Nama Ibu Kandung</option>
                        <option value="index.php?sort=jurusan" <?= isset($_GET['sort']) && $_GET['sort'] == 'jurusan' ? 'selected' : '' ?>>Jurusan</option>
                        <option value="index.php?sort=alamat" <?= isset($_GET['sort']) && $_GET['sort'] == 'alamat' ? 'selected' : '' ?>>Alamat</option>
                    </select>
                </div>
                <span class="sorting-link"><a href="<?= isset($_GET['sort']) ? 'index.php?sort=' . $_GET['sort'] . '&order=asc' : '#' ?>">ASC</a></span>
                <span class="sorting-link"><a href="<?= isset($_GET['sort']) ? 'index.php?sort=' . $_GET['sort'] . '&order=desc' : '#' ?>">DESC</a></span>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
        <?php if ($listSiswa->num_rows > 0) { ?>
            <div class="row" id="cardsContainer">
                <?php while ($siswa = $listSiswa->fetch_array()) { ?>
                    <div class="mb-3 d-flex">
                        <div class="card flex-grow-1">
                            <?php if (!empty($siswa['file'])) { ?>
                                <img src="http://localhost/progweb/pwpb21/assets/images/<?= $siswa['file'] ?>" class="card-img-top" alt="...">
                            <?php } else { ?>
                                <img src="assets/images/default-user.jpg" alt="Default Image" class="card-img-top">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $siswa['nama_lengkap'] ?></h5>
                                <div class="card-text">
                                    <p>NIS: <?= $siswa['nis'] ?></p>
                                    <p>Jenis Kelamin: <?= $siswa['jenis_kelamin'] ?></p>
                                    <p>Kelas: <?= $siswa['nama_kelas'] ?></p>
                                    <p>Golongan Darah: <?= $siswa['golongan_darah'] ?></p>
                                    <p>Nama Ibu Kandung: <?= $siswa['nama_ibu_kandung'] ?></p>
                                    <p>Jurusan: <?= $siswa['jurusan'] ?></p>
                                    <p>Alamat: <?= $siswa['alamat'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-end buttonGroup">
                                <div class="divEdit">
                                    <a class="btnEdit" href="edit.php?nis=<?= $siswa['nis'] ?>">
                                        <i class="ri-edit-line mr-1"></i>
                                    </a>
                                </div>
                                <div class="divDelete">
                                    <a class="btnDelete" data-toggle="modal" data-target="#confirmDeleteModal" data-nis="<?= $siswa['nis'] ?>" data-nama="<?= $siswa['nama_lengkap'] ?>">
                                        <i class="ri-delete-bin-line mr-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="mb-3 d-flex">
                    <div class="card flex-grow-1">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title">Masih belum ada data di sini, silahkan tambahkan data!</h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <b><span id="siswaName"></span></b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['welcome_message'])) : ?>
        <script>
            toastr.success('<?php echo $_SESSION['welcome_message']; ?>');
        </script>
        <?php unset($_SESSION['welcome_message']); ?>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
            $("input[type='search']").on('input', function() {
                var searchValue = $(this).val();

                $("form").submit();
            });

            $(".btnDelete").click(function() {
                var nis = $(this).data("nis");
                var nama = $(this).data("nama");
                var url = "delete.php?nis=" + nis;

                $("#siswaName").text(nama);

                $("#confirmDeleteBtn").attr("data-url", url);
                $("#confirmDeleteBtn").attr("data-nis", nis);
                $("#confirmDeleteBtn").attr("data-nama", nama);

                $("#confirmDeleteModal").modal("show");
            });

            $(".modal-footer .btn-secondary").click(function() {
                $("#confirmDeleteModal").modal("hide");
            });

            $("#confirmDeleteModal .close").click(function() {
                $("#confirmDeleteModal").modal("hide");
            });

            $("#confirmDeleteBtn").click(function() {
                var url = $(this).attr("data-url");
                var nis = $(this).attr("data-nis");
                var nama = $(this).attr("data-nama");

                $.post(url, function(data) {

                    if (data) {
                        $("#" + nis).remove();
                        toastr.success('Data ' + nama + ' berhasil dihapus', 'Informasi');
                        setTimeout(function() {
                            window.location.reload();
                        }, 200);
                    } else {
                        toastr.error('Gagal menghapus data ' + nama, 'Error');
                    }
                });


                $('#confirmDeleteModal').modal('hide');
            });

            $(".btn-logout").click(function() {
                $("#confirmLogoutModal").modal("show");
            });

            $(".modal-footer .btn-secondary").click(function() {
                $("#confirmLogoutModal").modal("hide");
            });

            $("#confirmLogoutModal .close").click(function() {
                $("#confirmLogoutModal").modal("hide");
            });

            $("#confirmLogoutModal").click(function(event) {
                if ($(event.target).hasClass('modal')) {
                    $("#confirmLogoutModal").modal("hide");
                }
            });

        });
    </script>
</body>

</html>