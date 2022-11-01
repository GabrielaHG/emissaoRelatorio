<?= $this->extend('layouts/moviment_layout') ?>

<?= $this->section('table') ?>
    <style>
        ul.pagination li {
            display: inline;
        }
        ul.pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
        .active {
            background-color: #4caf50;
            color: white;
        }
    </style>

        <script>
            function confirma() {
                if (!confirm('Deseja excluir o registro?')){
                    return false;
                }

                return true;
            }
        </script>

    <div class="container">
        <div class="row pt-3">
                <h4> <?= $title?> </h4>
                <hr>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?= anchor(base_url('moviment/create'), 'Add', ['class' => 'btn btn-primary'])?>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
            <?php foreach($moviments as $moviment): ?>
                <tr>
                    <td><?= $moviment['id'] ?></td>
                    <td><?= $moviment['description'] ?></td>
                    <td><?= $moviment['date'] ?></td>
                    <td><?= $moviment['value'] ?></td>
                    <td><?= $moviment['type'] ?></td>
                    <td>
                        <?= anchor('moviment/delete/'.$moviment['id'], 'Excluir', [
                            'onclick' => 'return confirma()'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= $pager->links() ?>
    </div>

<?= $this->endSection() ?>
