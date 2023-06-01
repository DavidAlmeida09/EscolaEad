  <?php
  include_once './lib/conexao.php';
  include('./lib/protect.php');
  protect(1);


  $sql_relatorios = "SELECT r.id, u.nome, c.titulo, r.data_compra, r.valor FROM relatorio AS r, usuarios AS u, cursos AS c WHERE u.id = id_usuario AND c.id=r.id_curso";
  $sql_query =  $mysqli->query($sql_relatorios) or die($mysqli->error);

  //verifica a quantidade de cursos cadastrados no banco de dados;
  $num_relatorios = $sql_query->num_rows;


  ?>

  <!-- Page-header start -->
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">

          <div class="d-inline">
            <h4>Relátorios</h4>
            <span>Visualize aqui os gastos do usário no sistema</span>
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
            <li class="breadcrumb-item"><a href="gerenciar_cursos.php">Relatorio</a>
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
        <div class="card">
          <div class="card-header">
            <h5>Relátorio</h5>
            <span>Examine o relátorio de compras do sistema</span>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Usuário</th>
                <th scope="col">Curso</th>
                <th scope="col">Data</th>
                <th scope="col">Valor</th>
              </tr>
            </thead>
            <tbody>
              <!--Verifica se o número de cursos cadastrados é igual a 0 -->
              <?php if ($num_relatorios == 0) { ?>
                <tr>
                  <td colspan="5">Nenhum relátorio cadastrado</td>
                </tr>
                <!--Caso seja maior que 0 -->
                <?php  } else {

                while ($relatorio = $sql_query->fetch_assoc()) {

                ?>
                  <tr>
                    <th scope="row"><?php echo $relatorio['id']; ?></th>
                    <td><?php echo $relatorio['nome']; ?></td>
                    <td><?php echo $relatorio['titulo']; ?></td>
                    <td><?php echo date("d/m/Y H:i",strtotime($relatorio['data_compra'])); ?></td>
                    <td>R$:<?php echo number_format($relatorio['valor'], '2', ',', '.'); ?></td>
                  </tr>

              <?php }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>