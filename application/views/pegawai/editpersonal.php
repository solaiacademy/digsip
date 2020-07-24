<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
        <form action="<?= base_url('user/editdatapersonal'); ?>" method="post">

                                  <input type="hidden" readonly value="<?=$row['user_id'];?>" name="user_id" id="user_id" class="form-control" >
                                  
                                  <div class="form-group row">
                                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?=$row['nik'];?>">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?=$row['tempat_lahir'];?>">
                                    </div>
                                  </div>

                                  
              
                                  <div class="form-group row">
                                          <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                          <div class="col-sm-10">
                                          <input type="date" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" value="<?=$row['tgl_lahir'];?>" style="font-size:12px" >
                                          </div>
                                  </div>
              
                                  <div class="form-group row">
                                    <label for="jenis_kelamin" class='col-sm-2 col-form-label'>Jenis Kelamin</label>
                                    <div class='col-sm-10'>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?=$row['jenis_kelamin'];?>">
                                    </div>
                                  </div>
              
                                  <div class="form-group row">
                                    <label for ="tingkat_pendidikan"class='col-sm-2 col-form-labe'>Tingkat Pendidikan</label>
                                    <div class='col-sm-10'>
                                    <select class="form-control"id="tingkat_pendidikan" name="tingkat_pendidikan">
                                          <option value="<?=$row['tingkat_pendidikan'];?>"><?=$row['tingkat_pendidikan'];?></option>                                                       
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
                                    </div>
                                  </div>
              
                                  <div class="form-group row">
                                    <label for="status_pegawai" class='col-sm-2 col-form-label'>Status Pegawai</label>
                                    <div class='col-sm-10'>
                                    <select class="form-control"id="status_pegawai" name="status_pegawai">
                                    <option value="<?=$row['status_pegawai'];?>"><?=$row['status_pegawai'];?></option>                                                       
                                    <option value="PNS">PNS</option>
                                    <option value="CPNS">CPNS</option>                               
                                    <option value="Honorer Provinsi">Honorer Provinsi</option>                             
                                    <option value="Honorer Sekolah">Honorer Sekolah</option> 
                                    </select>
                                    </div>
                                  </div>
              
                                  <div class="form-group row">
                                    <label for="tmt_awal" class='col-sm-2 col-form-label'>TMT Awal</label>
                                    <div class='col-sm-10'>
                                    <input type="date" class="form-control datepicker" id="tmt_awal" name="tmt_awal" value="<?=$row['tmt_awal'];?>" style="font-size:12px" >
                                    </div>
                                  </div>
              
              
              
              
                                  <div class="form-group row">
                                    <label for="jabatan" class='col-sm-2 col-form-label'>Jabatan</label>
                                    <div class='col-sm-10'>
                                    <select class="form-control"id="jabatan" name="jabatan">
                                          <option value="<?=$row['jabatan'];?>"><?=$row['jabatan'];?></option>                                                       
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
                                    </div>
                                  </div>
              
                          <div class="form-group row">
                                    <label class='col-sm-2 col-form-label'>No HP</label>
                                    <div class='col-sm-10'>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?=$row['no_hp'];?>">
                                    </div>
                          </div>                

            
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" style="font-size:18px">save</button>
                </div>
            </div>

            </form>



        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 