<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/generatenomorsurat'); ?>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label"><h3>Catatan</h3></label>
                <div class="col-sm-10">
                    <h3>Setiap pegawai yang meminta/menggunakan nomor surat, harap mengupload arsip pada menu <b>Arsip TU</b></h3>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Uraian Keperluan</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="deskripsi" name="deskripsi"placeholder="Tuliskan keterangan/keperluan nomor surat..." style="font-size:18px"></textarea>
                    <?= form_error('deskripsi', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>


            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">MINTA NOMOR SURAT</button>
                </div>
            </div>

            </form>



        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 