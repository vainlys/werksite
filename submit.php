<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Haal de gegevens uit het formulier op.
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $description = $_POST['description'];
  $image = $_FILES['image'];

  // Controleer of de map waarin de afbeelding is opgeslagen, bestaat en toegankelijk is.
  if (!is_dir($_FILES['image']['tmp_name'])) {
    // De map bestaat niet of is niet toegankelijk
    echo 'Er is iets misgegaan. Probeer het later opnieuw.';
    exit;
  }

  // Valideer de gegevens uit het formulier.
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Het e-mailadres is ongeldig
    echo 'Het e-mailadres is ongeldig.';
    exit;
  }

  if (!is_numeric($phone)) {
    // Het telefoonnummer is ongeldig
    echo 'Het telefoonnummer is ongeldig.';
    exit;
  }

  // Verzend de offerte aanvraag naar je e-mailadres.
  $to = 'info@sccreations.nl';
  $subject = 'Offerte aanvraag';
  $message = "
Naam: $name
E-mailadres: $email
Telefoonnummer: $phone
Adres: $address
Omschrijving: $description
Afbeelding: $image

Datum: 2023-10-13
Tijd: 12:00
";
  mail($to, $subject, $message);

  // Geef een succesbericht aan de gebruiker.
  echo 'Offerte aanvraag verzonden!';
} else {
  // Geef een foutbericht aan de gebruiker.
  echo 'Er is iets misgegaan. Probeer het later opnieuw.';
}

?>
