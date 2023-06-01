<?php
        include('./lib/protect.php');
        protect(0);
    

   include './lib/conexao.php';
   if (!isset($_SESSION)) {
       session_start();
   }
   $id_usuario = $_SESSION['usuario'];
   
   $query_cursos = $mysqli->query("SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);


   
?>
      
      <!-- Page-header start -->
      <div class="page-header card">
          <div class="row align-items-end">
              <div class="col-lg-8">
                  <div class="page-header-title">

                      <div class="d-inline">
                          <h4>Meus Cursos</h4>
                          <span>Cursos que você já possui</span>
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
                          <li class="breadcrumb-item"><a href="#!">Meus Cursos</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- Page-header end -->

      <div class="page-body">
          <div class="row">
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

                        <button class="btn form-control btn-out-dashed btn-primary btn-square">Assistir</button>
                    </div>
                </div>
            </div>
    </div>

<?php } ?>
          </div>
      </div>
      </div>


