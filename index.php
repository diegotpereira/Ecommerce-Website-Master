<?php
session_start();
include('db.php');
$status = "";

if (isset($_POST['codigo']) && $_POST['codigo'] != "") {
    # code...
    $codigo = $_POST['codigo'];
    $result = mysqli_query(
        $data_base,
        "SELECT * FROM `produtos` WHERE `codigo` = '$codigo'"
    );

    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $codigo = $row['codigo'];
    $preco = $row['preco'];
    $imagem = $row['imagem'];

    $carrinhoArray = array(
        $codigo => array(
            'nome' => $nome,
            'codigo' => $codigo,
            'preco' => $preco,
            'quantidade' => 1,
            'imagem' => $imagem
        )
    );

    if (empty($_SESSION["carrinho_compras"])) {
        # code...
        $_SESSION["carrinho_compras"] = $carrinhoArray;
        $status = "<div class='box'>O produto foi adicionado ao seu carrinho!</div>";
    } else {
        # code...
        $array_keys = array_keys($_SESSION["carrinho_compras"]);
        if (in_array($codigo, $array_keys)) {
            # code...
            $status = "<div class='box' style='color:red;'>
               O produto já foi adicionado ao seu carrinho!</div>";
        } else {
            # code...
            $_SESSION["carrinho_compras"] = array_merge(
                $_SESSION["carrinho_compras"],
                $carrinhoArray
            );

            $status = "<div class='box'>O produto foi adicionado ao seu carrinho!</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <div class="headder">
        <h2>DTP Software</h2>
        <div class="logo">
            <h2>DTP Software</h2>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Contato</a></li>
                <li><a href="#">Conta</a></li>
                <li>
                    <a href="/carrinho.php">
                        <img src="/cart-icon.png" />
                        <?php if (!empty($_SESSION["carrinho_compras"])) {
                            $carrinho_contagem = count(array_keys($_SESSION["carrinho_compras"]));
                        ?>
                            Carrinho</a>
                    <span>
                        <?php echo $carrinho_contagem; ?>
                    </span>
                <?php
                        }
                ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="message_box" style="margin: 10px 0px;">
        <?php echo $status; ?>
    </div>
    <br>

    <h2 class="telefones">Telefone Móveis</h2>
    <?php
    $result = mysqli_query($data_base, "SELECT * FROM `produtos` LIMIT 0,8");

    while ($row = mysqli_fetch_assoc($result)) {
        # code...
        echo "<div class='produto_wrapper'>
                 <form method='post' action=''>
                 <input type='hidden' name='codigo' value=" . $row['codigo'] . "/>
                 <div class='imagem'><img src='" . $row['imagem'] . "'></div>
                 <div class='nome'>" . $row['nome'] . "</div>
                 <div class='preco'>R$" . $row['nome'] . "</div>
                 <button type='submit' class='comprar'>Adicionar ao Carrinho</button>
                 </form>
                 </div>";
    }
    ?>
    <h2 class="notebooks">Notebook</h2>
    <?php
    $result = mysqli_query($data_base, "SELECT * FROM `produtos` LIMIT 8,8");

    while ($row = mysqli_fetch_assoc(($result))) {
        # code...
        echo "<div class='produto_wrapper'>
                 <form method='post' action=''>
                 <input type='hidden' name='codigo' value=" . $row['codigo'] . " />
                 <div class='imagem1'><img src='" . $row['imagem'] . "'></div>
                 <div class='nome'>" . $row['nome'] . "</div>
                 <div class='preco'>R$ " . $row['preco'] . "</div>
                 <button type='submit' class='comprar'>Adicionar ao Carrinho</button>
                 </form>
                 </div>";
    }
    ?>

    <h2 class="notebooks">Dispositivos vestíveis</h2>
    <?php
    $result = mysqli_query($data_base, "SELECT * FROM `produtos` LIMIT 16,24");
    while ($row = mysqli_fetch_assoc($result)) {
        # code...
        echo "<div class='produto_wrapper1'>
         <form method='post' action=''>
         <input type='hidden' name='codigo' value=" . $row['codigo'] . "/>
         <div class='imagem2'><img src='" . $row['imagem'] . "'></div>
         <div class='nome'>" . $row['nome'] . "</div>
         <div class='preco'>R$ " . $row['preco'] . "</div>
         <button type='submit' class='comprar1'>Adicionar ao Carrinho</button>
         </form>
         </div>";
    }
    mysqli_close($data_base);
    ?>

    <div style="clear:both;"></div>

    <div class="message_box" style="margin: 10px 0px;">
        <?php echo $status; ?>
    </div>
</body>

</html>