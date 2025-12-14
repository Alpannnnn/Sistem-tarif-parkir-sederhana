<!DOCTYPE html>
<html>
<head>
    <title>Master Tarif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Master Tarif (Hardcode)</h1>

    <p class="mb-4 text-gray-600">
        Tarif di bawah ini bersifat hardcode (tidak dari database).
    </p>

    <table class="w-full mt-4 border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Jenis</th>
                <th class="border p-2">Tarif Weekday</th>
                <th class="border p-2">Tarif Weekend</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="border p-2 font-semibold">Motor</td>
                <td class="border p-2">Rp <?= number_format(5000) ?></td>
                <td class="border p-2">Rp <?= number_format(7000) ?></td>
            </tr>

            <tr>
                <td class="border p-2 font-semibold">Mobil</td>
                <td class="border p-2">Rp <?= number_format(10000) ?></td>
                <td class="border p-2">Rp <?= number_format(15000) ?></td>
            </tr>
        </tbody>
    </table>

</div>

</body>
</html>
