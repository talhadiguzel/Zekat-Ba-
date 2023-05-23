<?php

if (isset($_POST['ad'], $_POST['soyad'], $_POST['telefon'],$_POST['email'],$_POST['sifre'])) {

    $ad = trim(filter_input(INPUT_POST, 'ad', FILTER_SANITIZE_STRING));
    $soyad = trim(filter_input(INPUT_POST, 'soyad', FILTER_SANITIZE_STRING));
    $telefon = trim(filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $sifre = trim(filter_input(INPUT_POST, 'sifre', FILTER_SANITIZE_STRING));
    

    if (empty($ad) || empty($soyad) || empty($email) || empty($telefon) || empty($sifre)) {
        die("<p>Lütfen formu eksiksiz doldurun!</p>");
    }

    if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
        die("<p>Lütfen geçerli bir e-posta adresin girin!</p>");
    }

    $baglanti = new mysqli("localhost","Talha","ZBMdUB@q91ilCh0g","Zekat"); 

    if ($baglanti->connect_errno > 0) {
        die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    }

    $baglanti->set_charset("utf8");

    $sorgu = $baglanti->prepare("INSERT INTO Kayit(ad,soyad,telefon,email,sifre)  VALUES(?,?,?,?,?)");

    $sorgu->bind_param('sssss',$ad,$soyad,$telefon,$email,$sifre);
    $sorgu->execute();

    if ($baglanti->errno > 0) {
        die("<b>Sorgu Hatası:</b> ". $baglanti->error);
    }

    echo "<p>Bilgiler başarılı bir şekilde kaydedildi.</p>";

    $sorgu->close();
    $baglanti->close();
}

?>