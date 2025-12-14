<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>

    <meta http-equiv="refresh" content="0;url=<?= base_url('auth/login') ?>">

    <script>
        // backup kalau meta refresh gagal
        window.location.href = "<?= base_url('auth/login') ?>";
    </script>
</head>
<body>
    <p>Sedang logout...</p>
</body>
</html>
