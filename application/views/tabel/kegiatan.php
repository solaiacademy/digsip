<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"></h1>
                <!-- begin add div -->
                <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#newKegiatanModal"><i class="fa fa-plus-circle" style="font-size:24px"></i></a>
                <!-- end add div -->
                
                <?= form_error('menu', '<div id="notifikasi" class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg-12">
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
                        <th scope="col">Kode Kegiatan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Kode Dinas</th>  
                        <th scope="col">Aksi</th>            
                    </tr>
                  </thead>
                  <tfoot>
                  <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Kegiatan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Kode Dinas</th> 
                        <th scope="col">Aksi</th>                 
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $i = 1; ?>
                    <?php foreach ($kegiatan as $t) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <th><?= $t['id_kegiatan']; ?></th>
                            <th><?= $t['objek_kegiatan']; ?></th>
                            <th><?= $t['id_table']; ?></th>
                            
                            
                            
                            <th>
                                <a data-toggle="modal" data-target="#modal-edit<?=$t['id_kegiatan'];?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                <!-- <a href="#" class=" btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></a> -->
                                <a href="<?= base_url('crud/delete/').$t['id_kegiatan']; ?>" onclick="return confirm('Apakah anda ingin menghapus data <?=$t['objek_kegiatan'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            </th>
                           
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

 
 <!-- Modal Add -->
 
<div class="modal fade" id="newKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="newKegiatanModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKegiatanModal">Add New Object</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('crud'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="objectname" name="objectname" placeholder="Nama kegiatan...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-circle btn-sm" data-dismiss="modal">X</button>
                    <button type="submit" class="btn btn-success btn-circle btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


 <!-- Modal Edit -->
 <?php $no=0; foreach($kegiatan as $row): $no++; ?>
 <div class="modal fade" id="modal-edit<?=$row['id_kegiatan'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Add New Object</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('crud/edit'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" readonly value="<?=$row['id_kegiatan'];?>" name="id_kegiatan" class="form-control" >
                    <div class="form-group">
                    <label class='col-md-3'>Kegiatan</label>
                    <div class='col-md-9'>
                        <!-- <input type="text" name="mod_name" autocomplete="off" value="<?=$row['objek_kegiatan'];?>" required placeholder="Masukkan Modal" class="form-control" > -->
                        <textarea name="objek_kegiatan"  class="form-control"><?php echo $row['objek_kegiatan']; ?></textarea>
                    </div>
                    </div>
                    <input type="hidden" readonly value="<?=$row['id_table'];?>" name="id_table" class="form-control" >
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-circle btn-sm" data-dismiss="modal">X</button>
                    <button type="submit" class="btn btn-success btn-circle btn-sm"><i class="fa fa-edit"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>



