<?php
//echo "<table border='1' cellpadding='5' cellspacing='0'>"; // Inicia a tabela com bordas e espaços
//
//// Gera a tabuada de 1 a 10 com cada operação em sua linha
//for ($j = 0; $j <= 10; $j++) { // Itera pelos multiplicadores (0 a 10)
//    echo "<tr>"; // Inicia uma nova linha na tabela
//    for ($i = 1; $i <= 10; $i++) { // Itera pelas bases (1 a 10)
//        echo "<td>$i x $j = " . ($i * $j) . "</td>"; // Exibe cada operação dentro de uma célula da tabela
//    }
//    echo "</tr>"; // Fecha a linha da tabela após exibir as 10 multiplicações
//}
//
//echo "</table>"; // Fecha a tabela

$mysql_host = 'container-mysql';
$mysql_dbname = 'db_web';
$mysql_user = 'user';
$mysql_password = 'user';

$clients = null;

try {
    $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_dbname", $mysql_user, $mysql_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM Clients');
    $stmt->execute();
    $clients = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="p-5">
    
    <h1>Clientes</h1>
    <hr>
    <?php if($clients) : ?>
        <table class="table table-striped" width="100%" >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clients as $client) : ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['first_name']; ?></td>
                        <td><?php echo $client['last_name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="bg-secondary text-white p-2">Número total de clientes: <strong><?= count($clients) ?></strong></p>

    <?php else: ?>
        <p>Não existem clientes para apresentar</p>
    <?php endif; ?>
</body>
</html>

