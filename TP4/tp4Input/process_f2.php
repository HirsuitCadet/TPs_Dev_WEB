<?php
function h($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$taille = isset($_POST['taille']) ? (int)$_POST['taille'] : 0;
$interieur = $_POST['interieur'] ?? 'plein';
$caractere = $_POST['caractere'] ?? '*';

if ($taille < 1) {
  $taille = 1;
}
if ($taille > 50) {
  $taille = 50;
}

$plein = ($interieur === 'plein');

$lines = array();
for ($i = 1; $i <= $taille; $i++) {
  if ($plein || $i === 1 || $i === $taille) {
    $lines[] = str_repeat($caractere, $i);
  } else {
    $inside = $i - 2;
    $lines[] = $caractere . str_repeat(' ', $inside) . $caractere;
  }
}
$triangle = implode("\n", $lines);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>TP n°4 - Traitements du deuxième formulaire</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; color: #111; }
    section { border: 1px solid #ddd; padding: 16px; margin: 16px 0; }
    pre { background: #f4f4f4; padding: 12px; }
  </style>
</head>
<body>
  <h1>TP n°4 - Traitements du deuxième formulaire</h1>
  <section>
    <h2>Dessin du triangle :</h2>
    <pre><?php echo h($triangle); ?></pre>
  </section>
  <p><a href="tp4.php">Retour</a></p>
</body>
</html>
