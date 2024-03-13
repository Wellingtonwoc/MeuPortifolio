<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $comment = $_POST['comment'];

    // Configure o URL do Formspree com seu próprio URL fornecido pelo Formspree
    $formspreeURL = 'https://formspree.io/f/xdoqdjpb';

    // Construa o corpo da mensagem
    $message = "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $telephone\n";
    $message .= "Message: $comment\n";

    // Use cURL para enviar os dados para o Formspree
    $ch = curl_init($formspreeURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'name' => $name,
        'email' => $email,
        'telephone' => $telephone,
        'comment' => $comment
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Verifique se o envio foi bem-sucedido e redirecione conforme necessário
    if ($response === 'OK') {
        // Redirecione de volta à página após o envio bem-sucedido
        header('Location: obrigado.html');
        exit;
    } else {
        // Em caso de falha no envio, exiba uma mensagem de erro
        echo '<script>alert("Houve um erro ao enviar a mensagem. Por favor, tente novamente mais tarde.");</script>';
    }
}
?>
