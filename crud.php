<!-- <?php

try {
    $pdo = new PDO(
        "mysql:dbname=crud;host=localhost",
        "root",
        "",
        );
} catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
}
catch(Exception $e){
    echo "Erro genérico: ".$e -> getMessage();
}

//---------------------Insert-----------------

//1 forma -> mais utilizada
// $res = $pdo -> prepare("INSERT INTO pessoa(nome, telefone, email) values(:n, :t, :e)");
// $res -> bindValue(":n", "Eduardo");
// $res -> bindValue(":t", "000111222");
// $res -> bindValue(":e", "teste@email.com");
// $res -> execute();

//2 forma->
//$pdo -> query("INSERT INTO pessoa(nome, telefone, email) Values('e', '222111000', 'e@email.com')");



//------------------------Delete e Update ----------------

// $delete = $pdo -> prepare("DELETE FROM pessoa WHERE id = :id");
// $id = 1;
// $delete -> bindValue(":id", $id);
// $delete -> execute();


// $delete = $pdo -> query("DELETE FROM pessoa WHERE id = '2'");

// $update = $pdo -> prepare("UPDATE pessoa SET email = :e WHERE id = :id");
// $update -> bindValue(":e", "e@gmail.com");
// $update -> bindValue(":id", 3);
// $update->execute();


// $update = $pdo -> query("UPDATE pessoa SET email = 'e@email.com' WHERE id = '3'");

//------------------Select-------------------

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cmd->bindValue(":id", 3);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as $key => $value) {
    echo $key." : ".$value."<br>";
}
?> -->