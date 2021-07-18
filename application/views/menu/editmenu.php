<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?php if ($title == "Menu Management") {
            echo "Edit Menu";
        } ?>
    </h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?= $menu['menu']; ?>">
                </div>
                <a href="<?= base_url('menu'); ?>" type="button" class="btn btn-sm btn-secondary">Back</a>
                <button type="submit" class="btn btn-sm btn-primary">Edit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->