<?php
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            CCB Visitas - Login
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    </head>

    <body class="">
        <div class="wrapper">            
            <div class="main-panel" style="width: 100%;">                
                <div class="panel-header panel-header-sm d-flex justify-content-center align-items-center mb-3">
                    <h2 class="text-white text-center mb-5">CCB Visitas<br></h2>
                </div>

                <div class="content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-center"><b>Login</b></h3>
                                </div>

                                <div class="card-body d-flex flex-column justify-content-center">
                                    <form class="container col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-size-16 text-bold" for="login">E-mail</label>
                                            <input type="email" class="form-control text-size-14" name="login" id="login" placeholder="Digite seu email">
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label class="text-size-16 text-bold" for="senha">Senha</label>
                                            <input type="password" class="form-control text-size-14" name="senha" id="senha" placeholder="Digite sua senha">
                                        </div>

                                        <div class="form-check">
                                            <small><a href="../recupera_senha" class="text-bold">Esqueci minha senha</a></small>
                                        </div>

                                        <div class="form-group d-flex justify-content-center mt-3">
                                            <input type="submit" class="btn btn-primary btn-round col-6 col-md-8 text-bold" name="entrar" value="ENTRAR">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                    
                    </div>

                    <?php include("assets/components/footer.php"); ?>
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chart JS -->
        <script src="assets/js/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="assets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    </body>
</html>