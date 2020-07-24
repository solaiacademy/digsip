<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?php 
if ($isemptydb <=0){
?>
<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMember"data-placement="bottom" title="Tambahkan Data"><i class="fa fa-plus-circle" style="font-size:18px"></i></a>
<?php
} else {?>
 <a href="<?= base_url('user/formedit'); ?>" class="btn btn-primary mb-3" title="Edit Data"><i class="fa fa-edit" style="font-size:18px"></i></a>
 <?php 
  }
 ?> 
  <a href="<?= base_url('user/arsip'); ?>" class="btn btn-primary mb-3"><i class="fas fa-folder-plus" style="font-size:18px">&nbsp;Arsip</i></a> 
  <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-edit"data-placement="bottom" title="Tambahkan Data"><i class="fa fa-edit" style="font-size:18px"></i></a> -->
 <?= $this->session->flashdata('message'); ?>
<tr>

    
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col">Atribut</th>  
      <th scope="col">Identitas</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>      
<?php $i = 1; ?>
<?php foreach ($infoperson as $m) : ?>
    <tr>
      <th scope="row"></th>
      <td>Nama</td>
      <td><?= $m['name']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>NIK</td>
      <td><?= $m['nik']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Tempat Lahir</td>
      <td><?= $m['tempat_lahir']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Tanggal Lahir</td>
      <td><?= $m['tgl_lahir']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Jenis Kelamin</td>
      <td><?= $m['jenis_kelamin']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Tingkat Pendidikan</td>
      <td><?= $m['tingkat_pendidikan']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Status Pegawai</td>
      <td><?= $m['status_pegawai']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>TMT</td>
      <td><?= $m['tmt_awal']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Jabatn</td>
      <td><?= $m['jabatan']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Telpon</td>
      <td><?= $m['no_hp']; ?></td>
      <th scope="row"></th>
    </tr>
    <tr>
      <th scope="row"></th>
      <td>Email</td>
      <td><?= $m['email']; ?></td>
      <th scope="row"></th>
    </tr>    
  <?php $i++; ?>
<?php endforeach ?>
  </tbody>
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
 
 <div class="modal fade" id="newMember" tabindex="-1" role="dialog" aria-labelledby="newMember" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="newMember"><span class="badge badge-success">Tambah Pegawai Baru</span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/addpegawai'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">

                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor KTP...">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir...">
                            <br>
                            <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                            <input type="date" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal lahir" style="font-size:12px" >
                            </div>
                            </div>
                          
                            <select class="form-control"id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">Jenis kelamin...</option>                                                       
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>   
                            </select>

                            <select class="form-control"id="tingkat_pendidikan" name="tingkat_pendidikan">
                            <option value="">Tingkat pendidikan...</option>                                                       
                            <option value="SD">SD</option>                            
                            <option value="SMP">SMP</option>  
                            <option value="SMA">SMA</option>                             
                            <option value="SMK">SMK</option>
                            <option value="Paket A">Paket A</option>  
                            <option value="Paket B">Paket B</option>
                            <option value="Paket C">Paket C</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            </select>
                            
                            <select class="form-control"id="status_pegawai" name="status_pegawai">
                            <option value="">Status Pegawai...</option>                                                       
                            <option value="PNS">PNS</option>
                            <option value="CPNS">CPNS</option>                               
                            <option value="Honorer Provinsi">Honorer Provinsi</option>                             
                            <option value="Honorer Sekolah">Honorer Sekolah</option> 
                            </select>

                            <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">TMT Awal</label>
                            <div class="col-sm-8">
                            <input type="date" class="form-control datepicker" id="tmt_awal" name="tmt_awal" placeholder="TMT awal..." style="font-size:12px" >
                            </div>
                            </div>


                            <select class="form-control"id="jabatan" name="jabatan">
                            <option value="">Jabatan...</option>                                                       
                            <option value="Kepala Sekolah">Kepala Sekolah</option>                            
                            <option value="Waka Kurikulum">Waka Kurikulum</option>  
                            <option value="Waka Kesiswaan">Waka Kesiswaan</option>                             
                            <option value="Waka Humas">Waka Humas</option>
                            <option value="Waka Sarpras">Waka Kesiswaan</option>  
                            <option value="Waka Kelas">Wali Kelas</option>
                            <option value="Kepala Jurusan">Kepala Jurusan</option>
                            <option value="Staff TU">Staff TU</option>
                            <option value="Petugas Taman">Petugas Taman</option>
                            <option value="Wakar Sekolah">Wakar Sekolah</option>
                            <option value="Operator">Operator</option>
                            </select>

                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No Telp/WA...">
                            
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



