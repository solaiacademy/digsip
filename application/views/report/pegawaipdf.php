<!DOCTYPE html>
<html><head>
	<title>Data GTK</title>
</head><body>


<h2 style="text-align:centre">DATA PEGAWAI SMKN 1 LINGGANG BIGUNG</h2>
<br>
<br>
<!-- sample table -->
                <table border="1" cellspacing="0">
                  <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tgl Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tingkat Pendidikan</th>
                            <th scope="col">Status Pegawai</th>
                            <th scope="col">TMT</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Telp</th>
                            <th scope="col">Email</th>                                   
                    </tr>
                  <?php $i = 1; ?>
                    <?php foreach ($member as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>'<?= (string)$m['nik']; ?></td>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['tempat_lahir']; ?></td>
                            <td><?= $m['tgl_lahir']; ?></td>
                            <td><?= $m['jenis_kelamin']; ?></td>
                            <td><?= $m['tingkat_pendidikan']; ?></td>
                            <td><?= $m['status_pegawai']; ?></td>
                            <td><?= $m['tmt_awal']; ?></td>
                            <td><?= $m['jabatan']; ?></td>
                            <td><?= $m['no_hp']; ?></td>
                            <td><?= $m['email']; ?></td>
                        </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
            </table>
</body></html>




