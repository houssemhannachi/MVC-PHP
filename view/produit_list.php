<?php include('./inc/header.php') ?>

<body>
	<div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2>Liste des <b>Produits</b></h2>
							<form action='index.php' method='GET'>
								<input type="hidden" name="action" value="save" />
								<button type="submit" class="btn btn-primary btn-success">Ajouter Produit</button>
							</form>

						</div>
					</div>
				</div>
				<div>
					<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="choice" onChange="getSelectValue()">
						<option selected value="0">Choisir une catégorie</option>
						<option value="7">Accessoir</option>
						<option value="5">Informatique</option>
						<option value="6">Bureautique</option>
					</select>
				</div>
				<table class="table table-striped table-hover" id="listprod">
					<thead>
						<tr>
							<th>Code</th>
							<th>Nom Produit</th>
							<th>Prix</th>
							<th>Quantité</th>
							<th>Catégorie</th>
							<th> Actions </th>

						</tr>
					</thead>
					<tbody
						<?php foreach ($produits as $p) { ?>
							<tr>
								<td> <?php echo $p->codepr ?></td>
								<td> <?php echo $p->designation ?></td>
								<td> <?php echo $p->prix ?></td>
								<td> <?php echo $p->qte ?></td>
								<td> <?php echo $p->nom; ?></td>
								<td>
									<form action='index.php' method='GET'>
										<input type="hidden" name="code" value="<?= $p->codepr ?>" />
										<input type="hidden" name="action" value="getByCode" />
										<button type="submit" class="btn btn-warning edit"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></button>
									</form>
								</td>
								<td>
									<form action='index.php' method='GET'>
										<input type="hidden" name="code" value="<?= $p->codepr ?>" />
										<input type="hidden" name="action" value="delete" />
										<button type="submit" class="btn btn-danger delete"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></button>
									</form>
								</td>

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<script>
			document.getElementById("list").onchange = function() {
				getSelectValue()
			};



				function getXMLHttpRequest() {
					var xhr = null;
					try {
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xhr = new XMLHttpRequest();
					}
					return xhr;
				}

				function getSelectValue() {
					var selectedValue = document.getElementById('choice').value;
					console.log(selectedValue);
					var xhr = getXMLHttpRequest();
					xhr.open("GET", "produitfilter.php?sv=" + selectedValue , true);
					xhr.send();
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							document.getElementById("listprod").innerHTML = xhr.responseText;
						}
					}
				}

			
		</script>


		<?php include('./inc/footer.php'); ?>