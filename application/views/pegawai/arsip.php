<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php
    if($this->session->userdata('id') ==$id){
    ?>
    <a href="<?= base_url('user/infopribadi'); ?>" class="btn btn-success mb-3"><i class="fas fa-home" style="font-size:12px"></i></a> 
    <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#newArsip"data-placement="bottom" title=""><i class="fa fa-plus-circle" style="font-size:12px"></i></a>
    <?php
    }
    ?>

 <?= $this->session->flashdata('message'); ?>
<tr>

    
<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Dokumen</th>  
      <th scope="col">Nama File</th>
      <?php
          if($this->session->userdata('id') ==$id){
      ?>
      <th scope="col">Aksi</th>
      <?php
            }else{ ?>
                <th scope="col"></th> 
      <?php  
            }
      ?>
    </tr>
  </thead>
  <tbody>      
<?php $i = 1; ?>
<?php foreach ($arsip as $m) : ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?=$m['doc_name']; ?></td>
      <td><a href="<?= base_url('assets/img/arsip/') . $m['doc_file']; ?>" rel="noopener noreferrer" target="_blank"><?=$m['doc_file']; ?></a></td>
      <td>
          <?php
          if($this->session->userdata('id') ==$id){
          ?>
          <a data-toggle="modal" data-target="#modal-edit<?=$m['id_arsip'];?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
          <a href="<?= base_url('user/deletearsip/').$m['id_arsip']; ?>" onclick="return confirm('Apakah anda ingin menghapus menu <?=$m['doc_name'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
          <?php
            }
          ?>
      </td>
    </tr>
  <?php $i++; ?>
<?php endforeach ?>
    <tfooter class="thead-dark">
    <tr class="table-dark">
      <th scope="col"></th>
      <th scope="col"></th>  
      <th scope="col"></th>     
      <th scope="col"></th>
      
    </tr>
  </tfooter>
</table>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 


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
            <form action="<?= base_url('user/addarsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                            <input type="text" class="form-control" id="doc_name" name="doc_name" placeholder="Tulis nama dokumen...">                                                        
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-2">Dokumen</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/doc/arsip/') ?>/default.png" class="img-thumbnail">
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
            <form action="<?= base_url('user/edit_arsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" readonly value="<?=$row['id_arsip'];?>" name="id_arsip" id="id_arsip" class="form-control" >
                    <input type="hidden" readonly value="<?=$row['id_user'];?>" name="id_user" id="id_user" class="form-control" >
                                  
                    <div class="form-group">
                      <label class='col-md-12'>Nama File</label>
                      <div class='col-md-12'>
                      <input type="text" class="form-control" id="doc_name" name="doc_name" value="<?=$row['doc_name'];?>">
                      </div>
                    </div>


                <div class="form-group row">
                <div class="col-sm-2">Arsip</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/arsip/') . $row['doc_file']; ?>" class="img-thumbnail">
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

                    
                    
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-circle btn-sm" data-dismiss="modal"><i class="fas fa-times-circle" style="font-size:18px"></i></button>
                    <button type="submit" ><span class="badge badge-success" style="font-size:18px">save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>