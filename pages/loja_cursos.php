<?php
  include('./lib/protect.php');
  protect(0);
include './lib/conexao.php';
if (!isset($_SESSION)) {
    session_start();
}
$id_usuario = $_SESSION['usuario'];

$query_cursos = $mysqli->query("SELECT * FROM cursos WHERE id NOT IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);

$erro = false;
if (isset($_POST['adquirir'])) {
    //verificar se possui créditos para comprar

    //puxa os créditos do usário
    $id_user = $_SESSION['usuario'];
    $sql_query_creditps = $mysqli->query("SELECT creditos FROM usuarios WHERE id='$id_user'") or die($mysqli->error);
    $usuario = $sql_query_creditps->fetch_assoc();

    $creditos_do_usuario = $usuario['creditos'];

    //puxa o valor do curso
    $id_curso = intval($_POST['adquirir']);

    $sql_query_cursos = $mysqli->query("SELECT preco FROM cursos WHERE id='$id_curso'") or die($mysqli->error);;
    $curso = $sql_query_cursos->fetch_assoc();

    $preco_curso = $curso['preco'];

    //verifica os valores
    if ($preco_curso > $creditos_do_usuario) {
        $erro = "Você não possui créditos para adquirir esse curso";
    }else{
        $mysqli->query("INSERT INTO relatorio (id_usuario, id_curso, valor, data_compra) VALUES($id_user, $id_curso, $preco_curso, NOW())") or die($mysqli->error);

        $novoCredito = $creditos_do_usuario - $preco_curso;

        $mysqli->query("UPDATE usuarios SET creditos ='$novoCredito' WHERE id = '$id_user'") or die($mysqli->error); 
        die("<script>location.href='index.php?p=meus_cursos'</script>");
    }

}
?>

<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">

                <div class="d-inline">
                    <h4>Loja de Cursos</h4>
                    <span>Adquira nossos cursos usando seu crédito</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Loja de cursos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($erro !== false) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo "$erro<br>";
                    ?>
                </div>
            <?php
            }
            
            ?>
        </div>
        <?php while ($curso  = $query_cursos->fetch_assoc()) { ?>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo $curso['titulo']; ?></h5>
                        <span><?php echo $curso['descricao_curta']; ?></span>
                    </div>
                    <div class="card-block">
                        <img src="<?php echo $curso['imagem']; ?>" class="img-fluid mb-3" alt="">
                        <p>
                            <?php echo $curso['conteudo']; ?>

                        </p>

                        <form action="" method="POST">
                            <button type="submit" name="adquirir" value="<?php echo $curso['id']; ?>" class="btn form-control btn-out-dashed btn-success btn-square">Adquirir por R$: <?php echo number_format($curso['preco'], 2, ',', '.'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

<?php } ?>
</div>
</div>