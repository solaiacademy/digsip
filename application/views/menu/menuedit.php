<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= base_url('menu/editmenu'); ?>" method="post">
                <div class="form-group row">
                    <label for="id" class="col-sm-4 col-form-label">Id</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="id" name="id" value="<?= $data_menu['id']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="menu_edit" class="col-sm-4 col-form-label">Menu name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="menu_edit" name="menu_edit" value="<?= $data_menu['menu']; ?>">
                        <?= form_error('menu_edit', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->