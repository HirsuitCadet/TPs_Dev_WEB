<?php
function h($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$genre = $_POST['genre'] ?? '';
$niveau = $_POST['niveau'] ?? '';
$langues = $_POST['langues'] ?? array();
$competences = $_POST['competences'] ?? array();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>TP n°4 - Traitement du premier formulaire</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; color: #111; }
    section { border: 1px solid #ddd; padding: 16px; margin: 16px 0; }
  </style>
</head>
<body>
  <h1>TP n°4 - Traitements du premier formulaire</h1>
  <section>
    <h2>Récapitulatif de vos informations :</h2>
    <ul>
      <li>Prénom : <?php echo h($prenom); ?></li>
      <li>Nom : <?php echo h($nom); ?></li>
      <li>Email : <?php echo h($email); ?></li>
      <li>Âge : <?php echo h($age); ?></li>
      <li>Genre : <?php echo h($genre); ?></li>
      <li>Niveau : <?php echo h($niveau); ?></li>
      <li>Langues : <?php echo h(implode(', ', $langues)); ?></li>
      <li>Compétences : <?php echo h(implode(', ', $competences)); ?></li>
    </ul>
  </section>
  <p><a href="tp4.php">Retour</a></p>
</body>
</html>
