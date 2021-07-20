<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?php if ($title == "Submenu Management") {
            echo "Edit Submenu";
        } ?>
    </h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"> <?= validation_errors() ?> </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $subMenuById['id']; ?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $subMenuById['title']; ?>">
                </div>
                <div class="form-group">
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option class="text-active" selected value="<?= $subMenuById['menu_id'] ?>"><?= $subMenuById['menu'] ?></option>
                        <option value="" class="font-italic text-muted"> - Select Menu - </option>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $subMenuById['url'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $subMenuById['icon'] ?>">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" <?php if ($subMenuById['is_active'] > 0) {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>
                <a href="<?= base_url('menu/submenu'); ?>" type="button" class="btn btn-sm btn-secondary">Back</a>
                <button type="submit" class="btn btn-sm btn-primary">Edit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->