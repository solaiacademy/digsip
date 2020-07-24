<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->



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
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Tanggal</th>  
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
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Tanggal</th>  
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
                    <?php foreach ($nomorsurat as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <?php
                            $currentmonth=date('F', $m['date_created']);
                            if($currentmonth=="January"){
                                $month="I";
                            }else if ($currentmonth=="February"){
                                $month="II";
                            }else if ($currentmonth=="March"){
                                $month="III";
                            }else if ($currentmonth=="April"){
                                $month="IV";
                            }else if ($currentmonth=="May"){
                                $month="V";
                            }else if ($currentmonth=="June"){
                                $month="VI";
                            }else if ($currentmonth=="July"){
                                $month="VII";
                            }else if ($currentmonth=="August"){
                                $month="VIII";
                            }else if ($currentmonth=="September"){
                                $month="IX";
                            }else if ($currentmonth=="October"){
                                $month="X";
                            }else if ($currentmonth=="November"){
                                $month="XI";
                            }else if ($currentmonth=="December"){
                                $month="XII";
                            }
                            ?>
                            <td>422.420/<?= $m['doc_number'].'/SMKN1LINGANGBIGUNG/'.$month.'/'.date('Y', $m['date_created']); ?> </td>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['deskripsi']; ?></td>
                            <td><?= date('d F Y h:i:sa', $m['date_created']); ?></td>                            
                            <?php 
                            if ($this->session->userdata('role_id')==3 || $this->session->userdata('role_id')==1){
                            ?>
                            <td> 
                            <a data-toggle="modal" data-target="#modal-edit<?=$m['doc_number'];?>" class="btn btn-warning btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('user/deletenomorsurat/').$m['doc_number']; ?>" onclick="return confirm('Apakah anda ingin menghapus data <?=$m['doc_number'];?> ?');" class="btn btn-danger btn-circle btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
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



<!-- Modal Edit -->
<?php $no=0; foreach($nomorsurat as $row): $no++; ?>
 <div class="modal fade" id="modal-edit<?=$row['doc_number'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/editnomorsurat'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" readonly value="<?=$row['user_id'];?>" name="user_id" id="user_id" class="form-control" >
                                  
                    <div class="form-group">
                      <label class='col-md-12'>Nomor Surat</label>
                      <div class='col-md-12'>
                      <input type="text" readonly class="form-control" id="doc_number" name="doc_number" value="<?=$row['doc_number'];?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class='col-md-12'>Keperluan</label>
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