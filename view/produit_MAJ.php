<?php
require('./inc/header.php');

?>


<body>
  <div id="modifier">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title ">Modifier un produit</h3>
        </div>
        <div class="modal-body">
          <form action="index.php" method=GET>

            <div class="form-group">
              <label for="">Designation:</label>
              <input type="text" class="form-control" name="designation" value=<?= $p->designation ?>>
            </div>
            <div class="form-group">
              <label for="">Catégorie:</label>
              <select class="form-control" name="code_categorie">
                <?php foreach ($categories as $c) { ?>
                  <option value="<?= $c->code ?>" <?php if ($c->code == $p->code_categorie) echo 'selected="selected"'; ?>><?php echo $c->nom; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Prix unitaire:</label>
              <input type="text" class="form-control" name="prix" value=<?= $p->prix ?>>
            </div>
            <div class="form-group">
              <label for="">Quantité:</label>
              <input type="text" class="form-control" name="qte" value=<?= $p->qte ?>>
            </div>
            <input type="hidden" name="code" value="<?= $p->codepr ?>" />
            <input type='hidden' name='action' value='FormProcess'>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require('./inc/footer.php'); ?>