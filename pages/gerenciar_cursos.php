  <?php
    include_once './lib/conexao.php';
    include('./lib/protect.php');
    protect(1);
  

    $sql_cursos = "SELECT * FROM cursos";
    $sql_query =  $mysqli->query($sql_cursos) or die($mysqli->error);

    //verifica a quantidade de cursos cadastrados no banco de dados;
    $num_cursos = $sql_query->num_rows;


    ?>

  <!-- Page-header start -->
  <div class="page-header card">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">

                  <div class="d-inline">
                      <h4>Gerenciar Cursos</h4>
                      <span>Administre os cursos cadastrados no sistema</span>
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
                      <li class="breadcrumb-item"><a href="gerenciar_cursos.php">Gerenciar Cursos</a>
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
                      <h5>Todos os Cursos</h5>
                      <span><a href="index.php?p=cadastrar_curso">Clique aqui</a> para cadastrar um curso</span>
                  </div>
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Imagem</th>
                              <th scope="col">Titulo</th>
                              <th scope="col">Preço</th>
                              <th scope="col">Gerenciar</th>
                          </tr>
                      </thead>
                      <tbody>
                          <!--Verifica se o número de cursos cadastrados é igual a 0 -->
                          <?php if ($num_cursos == 0) { ?>
                              <tr>
                                  <td colspan="5">Nenhum curso cadastrado</td>
                              </tr>
                              <!--Caso seja maior que 0 -->
                              <?php  } else {

                                while ($curso = $sql_query->fetch_assoc()) {

                                ?>
                                  <tr>
                                      <th scope="row"><?php echo $curso['id']; ?></th>
                                      <td> <img src="<?php echo $curso['imagem']; ?>" alt="" height="50"></td>
                                      <td><?php echo $curso['titulo']; ?></td>
                                      <td>R$:<?php echo number_format($curso['preco'], '2', ',', '.'); ?></td>
                                      <td><a href="index.php?p=editar_curso&id=<?php echo $curso['id']; ?>">Editar</a> | <a href="index.php?p=deletar_curso&id=<?php echo $curso['id']; ?>">Deletar</a></td>
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