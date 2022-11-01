<?= $this->extend('layouts/form_layout') ?>

<?= $this->section('form') ?>
    <div class="container">
        <div class="row pt-3">
                <h4> <?= $title?> </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <?= form_open('moviment/store') ?>
            <div class="form-group mt-3">
                <label>Descrição</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label>Valor</label>
                <input type="number" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"
name="value" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label>Tipo</label>
                <select name="type" class="form-control">
                    <option value="input">Input</option>
                    <option value="output">Output</option>
                </select>
                <div class="text-center mt-3">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
        <?= form_close() ?>
    </div>
    
<?= $this->endSection('form') ?>
