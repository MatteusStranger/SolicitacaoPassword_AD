<html>
<head>
    <title>Solicitação de uma nova senha para os usuários do AD do Instituto de Computação - IC/UFMT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="jquery.maskedinput/lib/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="jquery.maskedinput/src/jquery.maskedinput.js"></script>
    <script>
        jQuery(function ($) {
            $("#cpf").mask("999.999.999-99");
        });
    </script>
    <script language="javascript" type="text/javascript">
        function validar() {
            var nome = formulario.login.value;
            var email = formulario.email.value;
            if (nome == "") {
                alert('Preencha o campo com seu nome');
                formulario.login.focus();
                document.formulario.reset();
                return false;
            }
            if (email == "") {
                alert('Preencha o email');
                formulario.email.focus();
                document.formulario.reset();
                return false;
            }
            if (cpf == "") {
                alert('Preencha o cpf');
                formulario.cpf.focus();
                document.formulario.reset();
                return false;
            }
        }
    </script>
</head>
<body>
<br>
<br>
<br>
<div class="container" align="center">
    <img src="media/images/cropped-LogoTeste20_0_0.png" class="img-rounded" alt="Cinque Terre" width="500" height="94"
         align="center">
</div>
<div class="container text-center">
    <h2>Troca de senha</h2>
    <h3>Identifique-se para receber um e-mail com uma nova senha.</h3>
    <br>
    <div class="row text-center">
        <form name="formulario" role="form" class="form-inline text-center" action="resetPassword.php" method="post">
            <div class="form-group text-center">
                <div class="form-group text-center">
                    <label for="login" class="col-sm-2 control-label text-center">RGA</label>
                    <div class="col-sm-9 text-center">
                        <input type="text" size="55" class="form-control col-sm-8" id="login" name="login"
                               placeholder="Informe o seu número de matrícula." >
                    </div>
                </div>
                <br>
                <br>
                <div class="col-xs-20 text-center">
                    <div class="form-group text-center">
                        <label for="email" class="col-sm-2 control-label text-center">E-mail</label>
                        <div class="col-sm-4 text-center">
                            <input type="email" size="55" class="form-control" id="email" name="email"
                                   placeholder="Informe o seu e-mail cadastrado no sistema da UFMT.">
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-xs-20 text-center">
                    <div class="form-group text-center">
                        <label for="cpf" class="col-sm-2 control-label text-center">CPF</label>
                        <div class="col-sm-4 text-center">
                            <input type="text" size="55" class="form-control" id="cpf" name="cpf"
                                   placeholder="Informe o seu CPF.">
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="return validar()">Enviar dados
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<br>
<br>
<?php
$mess = isset($_REQUEST['mess']) ? $_REQUEST['mess'] : null;
if ($mess == 1) {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert('O e-mail fornecido não consta nos registros.');</script>";
    header("Refresh:0; url=index.php");
}
if ($mess == 2) {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert('Uma nova senha foi encaminhada para o seu e-mail.');</script>";
    header("Refresh:0; url=index.php");
}
if ($mess == 3) {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert('O usuário fornecido não consta nos registros.');</script>";
    header("Refresh:0; url=index.php");
}
if ($mess == 4) {
    echo "<script language=\"javascript\" type=\"text/javascript\">alert('O CPF fornecido não consta nos registros.');</script>";
    header("Refresh:0; url=index.php");
}
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="panel-footer" align="center">Esteja ciente que a operação pode demorar um pouco</div>
</body>
</html>