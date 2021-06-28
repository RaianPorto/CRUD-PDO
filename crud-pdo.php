<?php
    // ======================================== CONEXÃO ========================================

    try {

        $pdo = new PDO("mysql:dbname=CRUDPDO; host=localhost", "root", "");

    } catch (PDOException $e) {
        echo "Erro com banco de dados: ".$e->getMessage();
    } catch (Exception $e) {
        echo "Erro genérico: ".$e->getMessage();
    }

    // ======================================== INSERT ========================================

    // 1ª FORMA
    $res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:n, :t, :e)");

    // 1ª FORMA 
    // a) (Mais conhecido)
    // $res->bindValue(":n", "Raian");
    // $res->bindValue(":t", "0000000000");
    // $res->bindValue(":e", "teste@gmail.com");
    // $res->execute();

    // 1ª FORMA 
    // b) (Só aceita variáveis como parametros)
    // $nome = "Raian";
    // $res->bindParam(":n", $nome);

    // 2ª FORMA
    // $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES('Bruna', '01010101010', 'bru@gmail.com')");

    // ======================================== DELETE ========================================

    // $cmd = $pdo->prepare("DELETE FROM pessoa WHERE id = :id ");
    // $id = 1;
    // $cmd->bindValue(":id", $id);
    // $cmd->execute();

    // OU

    // $pdo->query("DELETE FROM pessoa WHERE id = '3' ");

    // ======================================== UPDATE ========================================

    // $cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id ");
    // $cmd->bindValue(":e", "raian@gmail.com");
    // $cmd->bindValue(":id", 3);
    // $cmd->execute();

    // $pdo->query("UPDATE pessoa SET email = 'Raian2@hotmail.com' WHERE id = '4' ");

    // ======================================== SELECT ========================================

    $cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
    $cmd->bindValue(":id", 4);
    $cmd->execute();
    $resultado = $cmd->fetch(PDO::FETCH_ASSOC); // Pega apenas um registro do banco de dados e transforma em um array
    // OU
    // $cmd->fetchAll(); // Quando buscar mais de um registro na query SQL e transforma em um array
    echo "<pre>";
    print_r($resultado);
    echo "</pre>";

    foreach ($resultado as $key => $value) {
        echo $key.":".$value."<br>";
    }