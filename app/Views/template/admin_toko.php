<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/bootstrap.min.css');?>">
</head>
<body>



    <nav
        class="nav justify-content-start align-content-center py-2 px-3 bg-secondary"
    >

    <h4><a href="<?= route_to('admin_toko.product_view') ?>" class="nav-link text-white">Product</a></h4>
    <h4><a href="<?= route_to('admin_toko.kategori_view') ?>" class="nav-link text-white">Kategori</a></h4>
    <h4><a href="" class="nav-link text-white">Etwas</a></h4>
    </nav>
    
    <div class="container-fluid">
            <?= $this->renderSection('admin_content'); ?>
    </div>


<style>

nav h4 a.nav-link {
    color: white;
    text-decoration: none;
    transition: text-shadow 0.3s ease-in;
}

nav h4 a.nav-link:hover {
    text-shadow: 0 0 1px white, 0 0 1px white   ;
    text-decoration: underline;
    text-decoration-color: white;
}

</style>

</body>
</html>