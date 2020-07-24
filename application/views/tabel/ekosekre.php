<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a> -->
            <!-- sample table -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Nama Perusahaan</th>
                        <th scope="col">No.Rek</th>
                        <th scope="col">No SPK</th>
                        <th scope="col">Nilai Kontrak</th>
                        <th scope="col">Sumber Dana</th>
                        <th scope="col">Thn Anggaran</th>    
                        <th scope="col">Aksi</th>               
                    </tr>
                  </thead>
                  <tfoot>
                  <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Nama Perusahaan</th>
                        <th scope="col">No.Rek</th>
                        <th scope="col">No SPK</th>
                        <th scope="col">Nilai Kontrak</th>
                        <th scope="col">Sumber Dana</th>
                        <th scope="col">Thn Anggaran</th>    
                        <th scope="col">Aksi</th>               
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $i = 1; ?>
                    <?php foreach ($table as $t) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $t['kegiatan']; ?></td>
                            <td><?= $t['lokasi']; ?></td>
                            <td><?= $t['kecamatan']; ?></td>
                            <td><?= $t['nama_perusahaan']; ?></td>
                            <td><?= $t['rekening']; ?></td>
                            <td><?= $t['no_spk']; ?></td>
                            <td><?= $t['nilai_kontrak']; ?></td>
                            <td><?= $t['sumber_dana']; ?></td>
                            <td><?= $t['thn_anggaran']; ?></td>
                            <td>
                            <a href="" class=" btn btn-info btn-circle btn-sm"> <i class="fas fa-edit"></i></a>
                            <a href="" class=" btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></a>
                                <!-- <a href="<?= base_url('') . '?id=' . $t['id']; ?>" class=" badge badge-success">edit</a>
                                <a href="<?= base_url('') . '?id=' . $t['id']; ?>" class=" badge badge-danger">delete</a> -->
                            </td>
                        </tr>
                    </tbody>
                    <?php $i++; ?>
                <?php endforeach ?>
            </table>
              </div>
            </div>
          </div>
            <!-- end sampletable -->


        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --  >       

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModal">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

