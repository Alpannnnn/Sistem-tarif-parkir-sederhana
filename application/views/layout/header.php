<?php $this->load->view('template/header'); ?>

<h3>Edit Area Parkir</h3>

<form method="post" action="<?= base_url('area_parkir/update') ?>">
    <input type="hidden" name="id_area" value="<?= $area->id_area ?>">

    <div class="mb-3">
        <label>Nama Area</label>
        <input type="text" name="nama_area" class="form-control" value="<?= $area->nama_area ?>">
    </div>

    <div class="mb-3">
        <label>Lokasi</label>
        <select name="lokasi" class="form-control">
            <option <?= $area->lokasi=='Basement'?'selected':'' ?>>Basement</option>
            <option <?= $area->lokasi=='Rooftop'?'selected':'' ?>>Rooftop</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

<?php $this->load->view('template/footer'); ?>
