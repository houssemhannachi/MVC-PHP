<?php
require('./model/Database.php');
$sv = $_GET['sv'];
$db = new Database();
if ($sv == 0) {
    $sql = "SELECT * from produit";
} else {
    $sql = "SELECT * from produit WHERE code_categorie = $sv";
}

$resultat = $db->execute_query($sql);
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);

echo '<thead>
<tr>
    <th>Code</th>
    <th>Nom Produit</th>
    <th>Prix</th>
    <th>Quantité</th>
</tr>
</thead>';
foreach ($res as $p) {
    echo '<tr>
    <td>' . $p['codepr'] . '</td>    
    <td>' . $p['designation'] . '</td>
    <td>' . $p['prix'] . '</td> 
    <td>' . $p['qte'] . '</td>
  </tr>';
}
