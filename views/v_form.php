<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghazi XI RPL 2</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .alert-group {
            position: absolute;
            width: calc(100% - 4rem);
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }

        .alert-group .alert {
            animation: fadeIn 2s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 1;
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            padding: 20px;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
            border-radius: 0.2rem;
        }

        .input-group input {
            width: 100%;
            height: 2.5rem;
            padding: 0 0.8rem;
            outline: none;
            border: 1.5px solid lightgray;
            border-radius: 0.2rem;
        }

        .placeholder {
            position: absolute;
            top: 7px;
            left: 8px;
            color: lightgray;
            padding: 0 6px;
            transition: all 0.3s;
        }

        .input-group input:focus+.placeholder,
        .input-group input.has-content+.placeholder {
            top: -11px;
            font-size: 13px;
            background-color: #fff;
            color: lightskyblue;
        }

        .input-group input:focus,
        .input-group input.has-content {
            color: lightskyblue;
            outline: 1.5px solid lightskyblue;
        }

        .custom-select {
            border: 1.5px solid lightgray;
            color: lightgray;
        }

        .custom-select:focus,
        .custom-select.has-content {
            outline: 1.5px solid lightskyblue;
            color: lightskyblue;
        }

        .custom-select option {
            color: black;
        }

        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-file-input {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .custom-file-input:focus+.custom-file-label,
        .custom-file-input.has-content+.custom-file-label {
            border-color: lightskyblue;
            color: lightskyblue;
        }

        .custom-file-label {
            position: relative;
            display: inline-block;
            width: 100%;
            padding: 0.25 0.75rem;
            border: 1.5px solid lightgray;
            background-color: #fff;
            color: lightgray;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .custom-file-label:hover {
            background-color: lightskyblue;
            color: #fff;
            border-color: lightskyblue;
        }
    </style>
</head>

<body>
    <?php
    $readonly = '';
    $form   = 'tambah';

    if (!empty($siswa)) {
        $readonly = 'readonly';
        $form   = 'edit';
    }
    ?>

    <div class="container">
        <div class="card">
            <form action="<?= $form . '.php' ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-self-center align-self-center">
                <div class="alert-group">
                    <?php if (!empty($success)) { ?>
                        <div class="alert alert-success">
                            <p><?= $success ?></p>
                        </div>
                    <?php } ?>

                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger">
                            <p><?= $error ?></p>
                        </div>
                    <?php } ?>
                </div>
                <h2 class="text-center mb-4">Form Siswa</h2>
                <div class="form-group d-flex justify-self-center align-self-center" style="width: fit-content;">
                <?php if ($form == 'edit') { ?>
                        <img src="http://localhost/progweb/pwpb21/assets/images/<?= $siswa['file'] ?>" height="128px" alt="" style="border-radius: 100%; border: 3px solid lightskyblue;">
                        <input type="hidden" name="foto_lama" value="<?= $siswa['file'] ?>">
                    <?php } ?>
                </div>
                <div class="form-group input-group">
                    <input type="text" id="nis" name="nis" <?= $readonly ?> value="<?= $form === 'edit' ? @$siswa['nis'] : '' ?>" <?= !empty($siswa['nis']) ? 'class="has-content"' : '' ?>>
                    <label for="nis" class="placeholder">NIS</label>
                </div>
                <div class="form-group input-group">
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= @$siswa['nama_lengkap'] ?>" <?= !empty($siswa['nama_lengkap']) ? 'class="has-content"' : '' ?>>
                    <label for="nama_lengkap" class="placeholder">Nama Lengkap</label>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" <?= @$siswa['jenis_kelamin'] == 'L' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= @$siswa['jenis_kelamin'] == 'P' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex flex-row justify-content-center align-items-center">
                    <select class="custom-select <?= !empty($siswa['id_kelas']) ? 'has-content' : '' ?>" id="kelas" name="kelas">
                        <option value="" selected hidden disabled>Pilih Kelas</option>
                        <?php while ($murid = $dataKelas->fetch_array()) { ?>
                            <option value="<?= $murid['id_kelas'] ?>" <?= @$siswa['id_kelas'] == $murid['id_kelas'] ? 'selected' : '' ?>>
                                <?= $murid['nama_kelas'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <select class="custom-select <?= !empty($siswa['golongan_darah']) ? 'has-content' : '' ?>" id="golongan_darah" name="golongan_darah">
                        <option value="" selected hidden disabled>Pilih Golongan Darah</option>
                        <option value="O" <?= @$siswa['golongan_darah'] == 'O' ? 'selected' : '' ?>>O</option>
                        <option value="A" <?= @$siswa['golongan_darah'] == 'A' ? 'selected' : '' ?>>A</option>
                        <option value="B" <?= @$siswa['golongan_darah'] == 'B' ? 'selected' : '' ?>>B</option>
                        <option value="AB" <?= @$siswa['golongan_darah'] == 'AB' ? 'selected' : '' ?>>AB</option>
                    </select>
                </div>
                <div class="form-group input-group">
                    <input type="text" id="nama_ibu_kandung" name="nama_ibu_kandung" value="<?= @$siswa['nama_ibu_kandung'] ?>" <?= !empty($siswa['nama_ibu_kandung']) ? 'class="has-content"' : '' ?>>
                    <label for="nama_ibu_kandung" class="placeholder">Nama Ibu Kandung</label>
                </div>
                <div class="form-group input-group">
                    <input type="text" id="alamat" name="alamat" value="<?= @$siswa['alamat'] ?>" <?= !empty($siswa['alamat']) ? 'class="has-content"' : '' ?>>
                    <label for="alamat" class="placeholder">Alamat</label>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="formFile" name="foto" onchange="updateFileName(this)" <?= $form == 'edit' ? 'value="' . $siswa['file'] . '"' : '' ?> />
                        <label class="custom-file-label" for="formFile" style="<?= $form == 'edit' ? 'color: lightskyblue; border-color: lightskyblue;' : '' ?>"><?= $form == 'edit' ? @$siswa['file'] : 'Pilih Foto' ?></label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        <?php if (!empty($success)) : ?>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 2000);
        <?php endif; ?>
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-group').fadeOut();
            }, 2000);
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focusout', function() {
                if (!this.value.trim() && !this.classList.contains('has-content')) {
                    this.classList.remove("has-content");
                } else {
                    this.classList.add("has-content");
                }
            });
        });

        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', function() {
                if (!this.value.trim() && !this.classList.contains('has-content')) {
                    this.classList.remove("has-content");
                } else {
                    this.classList.add("has-content");
                }
            });
        });

        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerHTML = fileName;
            label.style.color = 'lightskyblue';
            label.style.borderColor = 'lightskyblue';
        }
    </script>
</body>

</html>