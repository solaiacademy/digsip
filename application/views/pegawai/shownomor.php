<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/generatenomorsurat'); ?>

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label"><h3>Catatan</h3></label>
                <div class="col-sm-8">
                    <h3>Setiap pegawai yang meminta/menggunakan nomor surat, harap mengupload arsip pada menu <b>Arsip TU</b></h3>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nomor Surat Anda</label>
                <div class="col-sm-8">
                <?php
                            $currentmonth=date('F', $nomorsuratanda['date_created']);
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
               <h2><span class="badge badge-danger"><?= $nomorsuratanda['doc_number']; ?></span></h2>
                </div>
            </div>

            </form>



        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 