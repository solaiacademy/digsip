<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<!-- begin add div -->
<a href="<?= base_url('user/kepegawaianExportExcel/'); ?>" target="_blank" class="btn btn-primary mb-3" ><i class="fa fa-download" style="font-size:12px"> Export Excel</i></a>
<a href="<?= base_url('user/kepegawaianExportPdf/'); ?>" target="_blank" class="btn btn-warning mb-3" ><i class="fa fa-file" style="font-size:12px"> Export Pdf</i></a>
<a href="<?= base_url('user/kepegawaianExportPdf/'); ?>" target="_blank" class="btn btn-danger mb-3" ><i class="fa fa-print" style="font-size:12px"> Print</i></a>
<!-- end add div -->

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

           
            <!-- sample table -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table-warning">
                  <tr>
                  <th scope="col">#</th>
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
                            <th scope="col">Arsip</th>   
                            <?php 
                            if ($this->session->userdata('role_id')==1){
                            ?>   
                        <th scope="col">Aksi</th>  
                            <?php
                        }?>           
                    </tr>
                  </thead>
                  <tfoot class="table-warning">
                  <tr>
                  <th scope="col">#</th>
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
                            <th scope="col">Arsip</th>  
                        <?php 
                            if ($this->session->userdata('role_id')==1){
                            ?>   
                        <th scope="col">Aksi</th>  
                            <?php
                        }?>               
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $i = 1; ?>
                    <?php foreach ($member as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['nik']; ?></td>
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
                            <td> <a href="<?= base_url('user/switcharsip/').$m['user_id']; ?>" class=""><i class="fas fa-folder-plus"></i></a></td>
                            <?php 
                            if ($this->session->userdata('role_id')==1){
                            ?>
                            <td> 
                            <a href="<?= base_url('user/formeditpegawai/').$m['nik']; ?>"  class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url('user/deletepegawai/').$m['nik']; ?>" onclick="return confirm('Apakah anda ingin menghapus data <?=$m['nik'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            </td>
                            <?php
                            }?>
                        </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
                    </tbody>
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




