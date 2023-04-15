<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Définir les paramètres de l'upload
    $uploadDir = 'public/uploads/';
    $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;

    // Gérer les erreurs
    $errors = [];
    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg, Jpeg, Png, Gif ou Webp !';
    }
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    // Si pas d'erreur, télécharger l'image
    if (empty($errors)) {
        $filename = uniqid() . '.' . $extension;
        $uploadFile = $uploadDir . $filename;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        echo '<h2>Voici votre photo de profil :</h2>';
        echo '<img src="' . $uploadFile . '" alt="Avatar">';
        echo '<p>Nom : Homer Simpson</p>';
        echo '<p>Prénom : Homer</p>';
        echo '<p>Age : 40 ans</p>';
    } else {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload une image de profil :</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Envoyer</button>
    <input type="hidden" name="delete">
    <button type="submit">Supprimer</button>
</form>


<?php
// Gérer la suppression de l'image
if (isset($_POST['delete'])) {
    $fileToDelete = $_POST['delete'];
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo '<p>Le fichier a été supprimé avec succès.</p>';
    } else {
        echo '<p>Le fichier n\'existe pas.</p>';
    }
}
?>