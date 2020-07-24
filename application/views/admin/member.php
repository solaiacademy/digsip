<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <caption>List of members</caption>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">TEMPAT LAHIR</th>
                            <th scope="col">TGL LAHIR</th>
                            <th scope="col">JENI KELAMIN</th>
                            <th scope="col">JURUSAN</th>
                            <th scope="col">TINGKAT PENDIDIKAN</th>
                            <th scope="col">STATUS PEGAWAI</th>
                            <th scope="col">NAMA SEKOLAH</th>
                            <th scope="col">JENJANG</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">NUPTK</th>
                            <th scope="col">TAHUN MULAI HONOR</th>
                            <th scope="col">KATEGORI</th>
                            <th scope="col">NO SK</th>
                            <th scope="col">STATUS PEGAWAI</th>
                            <th scope="col">SERTIFIKASI</th>
                            <th scope="col">TELP</th>
                            <th scope="col">LOKASI SEKOLAH</th>
                            <th scope="col">USER ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($member as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['nik']; ?></td>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['birth_place']; ?></td>
                            <td><?= $m['birth_date']; ?></td>
                            <td><?= $m['gender']; ?></td>
                            <td><?= $m['education']; ?></td>
                            <td><?= $m['education_degree']; ?></td>
                            <td><?= $m['employee_state']; ?></td>
                            <td><?= $m['agency_name']; ?></td>
                            <td><?= $m['level']; ?></td>
                            <td><?= $m['school_status']; ?></td>
                            <td><?= $m['nuptk']; ?></td>
                            <td><?= $m['year_of_work']; ?></td>
                            <td><?= $m['category']; ?></td>
                            <td><?= $m['work_leter_number']; ?></td>
                            <td><?= $m['job_desc']; ?></td>
                            <td><?= $m['certificated']; ?></td>
                            <td><?= $m['phone_number']; ?></td>
                            <td><?= $m['school_district']; ?></td>
                            <td><?= $m['user_id']; ?></td>
                            <td>
                                <a href="" class="badge badge-success">edit</a>
                                <a href="" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                    </tbody>
                    <?php $i++; ?>
                    <?php endforeach ?> -->
                </table>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --  >                        