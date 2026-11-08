<?php

$host = 'localhost';
$dbname = 'nom_de_ta_base';
$username = 'ton_utilisateur';
$password = 'ton_mot_de_passe';

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $date_naissance = $_POST['date_naissance'];
        $email = trim($_POST['email']);
        $mot_de_passe_brut = $_POST['mot_de_passe'];

        $mot_de_passe_hash = password_hash($mot_de_passe_brut, PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO utilisateurs (nom, prenom, date_naissance, email, mot_de_passe) VALUES (:nom, :prenom, :date_naissance, :email, :mot_de_passe)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $date_naissance,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe_hash
        ]);

        echo "Inscription réussie ! Bienvenue sur le site.";
    }

} catch (PDOException $e) {
    
    echo "Erreur : " . $e->getMessage();
}
?> 