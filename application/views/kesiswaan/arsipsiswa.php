<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->


<!-- begin add div -->
<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newArsip"data-placement="bottom" title="Tambahkan Arsip"><i class="fas fa-folder-plus" style="font-size:18px">&nbsp;Arsip</i></a> 
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
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Nama Dokumen</th>
                        <th scope="col">Nomor Dokumen</th>
                        <th scope="col">Nama File</th>                        
                        <th scope="col">Tanggal Dokumen</th>
                        <th scope="col">Deskripsi</th> 
                        <?php 
                            if ($this->session->userdata('role_id')==3 || $this->session->userdata('role_id')==1){
                            ?>   
                        <th scope="col">Aksi</th>  
                            <?php
                        }?>             
                    </tr>
                  </thead>
                  <tfoot class="table-warning">
                  <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Nama Dokumen</th>
                        <th scope="col">Nomor Dokumen</th>
                        <th scope="col">Nama File</th>                        
                        <th scope="col">Tanggal Dokumen</th>
                        <th scope="col">Deskripsi</th> 
                        <?php 
                            if ($this->session->userdata('role_id')==3 || $this->session->userdata('role_id')==1){
                            ?>   
                        <th scope="col">Aksi</th>  
                            <?php
                        }?>                 
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $i = 1; ?>
                    <?php foreach ($arsip as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['nis']; ?></td>
                            <td><?= $m['nama_siswa']; ?></td>
                            <td><?= $m['doc_name']; ?></td>
                            <td><?= $m['doc_number']; ?></td>
                            <td><a href="<?= base_url('assets/doc/nilai/') . $m['doc_file']; ?>" rel="noopener noreferrer" target="_blank"><?=$m['doc_file']; ?></a></td>
                            <td><?= $m['doc_date']; ?></td>
                            <td><?= $m['deskripsi']; ?></td>
                            <?php 
                            if ($this->session->userdata('role_id')==3 || $this->session->userdata('role_id')==1){
                            ?>
                            <td> 
                            <a data-toggle="modal" data-target="#modal-edit<?=$m['id_arsip'];?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('Kesiswaan/delete_arsip_siswa/').$m['id_arsip']; ?>" onclick="return confirm('Apakah anda ingin menghapus data <?=$m['doc_name'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
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




 <!-- Modal insert --> 
 <div class="modal fade" id="newArsip" tabindex="-1" role="dialog" aria-labelledby="newArsip" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="newArsip"><span class="badge badge-success">Tambah Arsip</span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kesiswaan/addarsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis NIS siswa...">                                                        
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Tulis nama siswa...">                                                        
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Tulis nama dokumen...">                                                        
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="doc_number" name="doc_number" placeholder="Tulis nomor dokumen...">                                                        
                    </div>

                    <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Tanggal Dokumen</label>
                            <div class="col-sm-8">
                            <input type="date" class="form-control datepicker" id="doc_date" name="doc_date" placeholder="Tanggal dokumen" style="font-size:12px" >
                            </div>
                    </div>
                          

                    <div class="form-group row">
                    <div class="col-sm-2">File</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/doc/kesiswaan/') ?>/default.png" class="img-thumbnail">
                            </div>

                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="doc_file" name="doc_file">
                                    <label class="custom-file-label" for="doc_file">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                          <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Tuliskan keterangan/keperluan dokumen..." style="font-size:18px"></textarea>                                                     
                    </div>
                </div>

                <div class="modal-footer">                   
                    <button type="button" class="btn btn-success btn-circle btn-sm" data-dismiss="modal"><i class="fas fa-times-circle" style="font-size:12px"></i></button> 
                    <button type="submit" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus-circle" style="font-size:12px"></i></button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- End modal insert -->



<!-- Modal Edit -->
<?php $no=0; foreach($arsip as $row): $no++; ?>
 <div class="modal fade" id="modal-edit<?=$row['id_arsip'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Data Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kesiswaan/edit_arsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" readonly value="<?=$row['id_arsip'];?>" name="id_arsip" id="id_arsip" class="form-control" >
                                  
                    <div class="form-group">
                      <label class='col-md-12'>NIS</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="nis" name="nis" value="<?=$row['nis'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class='col-md-12'>Nama Siswa</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?=$row['nama_siswa'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class='col-md-12'>Nama Dokumen</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="doc_name" name="doc_name" value="<?=$row['doc_name'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class='col-md-12'>No Dokumen</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="doc_number" name="doc_number" value="<?=$row['doc_number'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class='col-md-12'>Tanggal Dokumen</label>
                      <div class='col-md-12'>
                      <input type="date" class="form-control datepicker" id="doc_date" name="doc_date" placeholder="" style="font-size:12px" value="<?=$row['doc_date'];?>">
                      </div>
                    </div>


                <div class="form-group row">
                <div class="col-sm-2">File</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/doc/kesiswaan/') . $row['doc_file']; ?>" class="img-thumbnail">
                        </div>

                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="doc_file" name="doc_file" value="<?=$row['doc_file']; ?>">
                                <label class="custom-file-label" for="doc_file">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                      <label class='col-md-12'>Keterangan</label>
                      <div class='col-md-12'>
                      <textarea class="form-control" id="deskripsi" name="deskripsi"><?=$row['deskripsi'];?></textarea>
                      </div>
            </div>                    
                    
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-circle btn-sm" data-dismiss="modal"><i class="fas fa-times-circle" style="font-size:18px"></i></button>
                    <button type="submit" class="btn btn-success btn-circle btn-sm" ><i class="fa fa-edit"> save</i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>