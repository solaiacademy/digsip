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
                        <th scope="col">Nama Dokumen</th>
                        <th scope="col">Nama File</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Kelas</th>
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
                        <th scope="col">Nama Dokumen</th>
                        <th scope="col">Nama File</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Kelas</th>
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
                            <td><?= $m['doc_name']; ?></td>
                            <td><a href="<?= base_url('assets/doc/nilai/') . $m['doc_file']; ?>" rel="noopener noreferrer" target="_blank"><?=$m['doc_file']; ?></a></td>
                            <td><?= $m['tahun']; ?></td>
                            <td><?= $m['semester']; ?></td>
                            <td><?= $m['kelas']; ?></td>
                            <td><?= $m['deskripsi']; ?></td>
                            <?php 
                            if ($this->session->userdata('role_id')==3 || $this->session->userdata('role_id')==1){
                            ?>
                            <td> 
                            <a data-toggle="modal" data-target="#modal-edit<?=$m['id_arsip'];?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('Kurikulum/deletearsipnilai/').$m['id_arsip']; ?>" onclick="return confirm('Apakah anda ingin menghapus data <?=$m['doc_name'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
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
            <form action="<?= base_url('kurikulum/addarsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                            <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Tulis nama dokumen...">                                                        
                    </div>

                    <div class="form-group row">
                    <select class="form-control"id="kelas" name="kelas">
                            <option value="">Pilih kelas...</option>                                                       
                            <option value="X TKJ">X TKJ</option>
                            <option value="XI TKJ">XI TKJ</option>
                            <option value="XII TKJ">XII TKJ</option>                                                        
                            <option value="X AKL">X AKL</option>
                            <option value="XI AKL">XI AKL</option>
                            <option value="XII AKL">XII AKL</option>                                                        
                            <option value="X OTKP">X OTKP</option>
                            <option value="XI OTKP">XI OTKP</option>
                            <option value="XII OTKP">XII OTKP</option>                             
                               
                    </select>
                    </div>
                    
                    <div class="form-group row">
                    <select class="form-control"id="semester" name="semester">
                            <option value="">Pilih semester...</option>                                                       
                            <option value="Genap">Genap</option>
                            <option value="Ganjil">Ganjil</option>   
                    </select>
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun...">                                                        
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-2">Dokumen</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/doc/nilai/') ?>/default.png" class="img-thumbnail">
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
                          <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Keterangan..." style="font-size:12px"></textarea>                                                     
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
            <form action="<?= base_url('kurikulum/edit_arsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" readonly value="<?=$row['id_arsip'];?>" name="id_arsip" id="id_arsip" class="form-control" >
                                  
                    <div class="form-group">
                      <label class='col-md-12'>Nama File</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="doc_name" name="doc_name" value="<?=$row['doc_name'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                                <div>                                   
                                <label class='col-md-12'>Semester</label> 
                                </div>
                                <div class='col-md-12'>
                                    <select class="form-control"id="semester" name="semester">
                                    <option value="<?=$row['semester'];?>" selected><?=$row['semester'];?></option>  
                                    <?php if($row['semester']=='Genap') { ?>
                                       <option value="Ganjil">Ganjil</option>
                                    <?php
                                     }if($row['semester']=='Ganjil') { ?>
                                      <option value="Ganjil">Ganjil</option>
                                     <?php }else{ ?>
                                      <option value="Genap">Genap</option>
                                      <option value="Ganjil">Ganjil</option>
                                     <?php
                                     } 
                                     ?>                      
                                   
                                    </select>
                                </div>
                    </div>


                    <div class="form-group">
                                <div>                                   
                                <label class='col-md-12'>Kelas</label> 
                                </div>
                                <div class='col-md-12'>
                                <select class="form-control"id="kelas" name="kelas">
                                    <option value="<?=$row['kelas'];?>" selected><?=$row['kelas'];?></option>                                                       
                                    <option value="X TKJ">X TKJ</option>
                                    <option value="XI TKJ">XI TKJ</option>
                                    <option value="XII TKJ">XII TKJ</option>                                                        
                                    <option value="X AKL">X AKL</option>
                                    <option value="XI AKL">XI AKL</option>
                                    <option value="XII AKL">XII AKL</option>                                                        
                                    <option value="X OTKP">X OTKP</option>
                                    <option value="XI OTKP">XI OTKP</option>
                                    <option value="XII OTKP">XII OTKP</option>  
                                    </select>
                                </div>
                    </div>

                

                    <div class="form-group">
                      <label class='col-md-12'>Tahun</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="tahun" name="tahun" value="<?=$row['tahun'];?>">
                      </div>
                    </div>


                <div class="form-group row">
                <div class="col-sm-2">File</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/doc/nilai/') . $row['doc_file']; ?>" class="img-thumbnail">
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