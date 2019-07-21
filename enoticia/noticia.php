<?php

include_once('./includes/header.php');
include('./controle/conexao.php');
include_once('./includes/menu.php');

$result = mysqli_query($conn, "SELECT * FROM noticia ORDER BY RAND() LIMIT 5");

$count = 0;
while ($row = mysqli_fetch_row($result)) {
    $postsarray["titulo" . $count] = $row[1];
    $postsarray["descricao" . $count] = $row[2];
    $postsarray["imagem" . $count] = $row[3];
    $count++;
}
?>

<main role="main bg-light">

    <div class="py-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-md-12 <?php echo $count > 4? 'col-xl-8':'' ?> col-lg-12 mb-3 mb-sm-3 pr-xl-1 pr-lg-1">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                                for ($i = 0; $i < 3 && isset($postsarray["imagem" . $i]); $i++) :
                            ?>
                            <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
                            <?php
                                endfor;
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            for ($i = 0; $i < 3 && isset($postsarray["imagem" . $i]); $i++) :
                                ?>
                                <div class='carousel-item <?php echo $i == 0 ? 'active' : ''; ?> zoom'>
                                    <img src="images/<?php echo $postsarray["imagem" . $i]; ?>" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5><?php echo $postsarray["titulo" . $i]; ?></h5>
                                        <p><?php echo  utf8_encode ($postsarray["descricao" . $i]); ?></p>
                                    </div>
                                </div>
                            <?php
                            endfor;
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Proximo</span>
                        </a>
                    </div>
                </div>
                
                    <div class="col-12 col-xl-4 col-lg-4 p-0 d-none d-xl-block">
                    <?php
                    if($count > 4) :
                        for ($i = 3; $i < $count; $i++) :
                    ?>
                        <div class="col-12 p-0 overflow" style="<?php echo $i == 4?'margin-top:3%':''; ?>">
                            <div class="card bg-dark text-white border-0 zoom">
                                <img src="images/<?php echo $postsarray["imagem" . $i]; ?>" class="card-img rounded-0 img-fluid" >
                                <div class="card-img-overlay">
                                    <div class="text-overlay">
                                        <a class="badge badge-primary rounded-0" href="#"><?php echo  utf8_encode ($postsarray["titulo" . $i]); ?></a>
                                        <a class="text-white" href="#"><?php echo  utf8_encode ($postsarray["titulo" . $i]); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            endfor;
                        endif;
                        ?>
                    </div>
                </div>

                <div class="row p-0 d-flex justify-content-around">

                    <?php
                    $noticia = " SELECT * FROM noticia";
                    $result_noticia = mysqli_query($conn, $noticia);

                    ?>
                    <?php
                    while ($row_noticia = mysqli_fetch_assoc($result_noticia)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm border-1 bg-white overflow rounded-0">
                                <div class="zoom">
                                    <img src="images/<?php echo  utf8_encode ($row_noticia['imagem_noticia']); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <p class="card-title" style="font-weight: bold;"><?php echo  utf8_encode ($row_noticia['titulo_noticia']); ?></p>
                                    <p class="card-text"><?php echo utf8_encode (  $row_noticia['conteudo_noticia']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-0">Leia
                                                mais</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }


                    ?>

                </div>
            </div>
        </div>
    </main>

    <?php include_once('includes/footer.php'); ?>
    <!-- JS -->
    <!-- <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

    </html> -->