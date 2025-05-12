<!DOCTYPE html>
<html lang="en">
<style>
#layoutSidenav_content {
    padding-top: 4rem;
    /* atau 60px */
}
</style>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= $main_url ?>asset/sb-admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="<?= $main_url ?>asset/image/toga.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<style>
html,
body {
    height: 100%;
}

#layoutSidenav_content {
    display: flex;
    flex-direction: column;
}

footer {
    margin-top: auto;
}
</style>