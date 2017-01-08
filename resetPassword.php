<?php
echo("<pre>");
require_once dirname(__FILE__) . '/adLDAP/src/adLDAP.php';
try {
    $adldap = new adLDAP();
} catch (adLDAPException $e) {
    echo $e;
    exit();
}
$adldap->connect();

$nome = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);
$cpf = htmlspecialchars($_POST['cpf']);

$cpf = formatarCPF($cpf);

$fields = [
    'description'
];

$collection = $adldap->user()->infoCollection($nome);
$collectionCPF = $adldap->user()->info($nome, $fields);


echo "<pre>";
//echo $cpf . "\n";
$cpfAD = $collectionCPF[0]['description'][0];


if ($collection->samaccountname == $nome) {
    if ($collection->mail == $email) {
        if ($cpfAD == $cpf) {
            //echo "Dados validados\n";
        } else {
            header("Location:index.php?mess=4");
            $adldap->close();
            die(1);
        }
    } else {
        header("Location:index.php?mess=1");
        $adldap->close();
        die(1);
    }
} else {
    header("Location:index.php?mess=3");
    $adldap->close();
    die(1);
}

$attributes = array(
    "change_password" => 1,
);

$result = $adldap->user()->modify($nome, $attributes);
$nomeSemAcento = removerCaracter($collection->displayName);
$nomeExplode = explode(" ", $nomeSemAcento);
$senha_nova = (ucfirst($nomeExplode[0])) . '@' . round(microtime(true) % 10000);
try {
    $result = $adldap->user()->password($nome, $senha_nova);

} catch (adLDAPException $e) {
    echo $e;
    exit();
}

enviaEmail($senha_nova, $collection->mail);

$adldap->close();

exit(0);

function removerCaracter($string)
{
// assume $str esteja em UTF-8
    $map = array(
        'á' => 'a',
        'à' => 'a',
        'ã' => 'a',
        'â' => 'a',
        'é' => 'e',
        'ê' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ú' => 'u',
        'ü' => 'u',
        'ç' => 'c',
        'Á' => 'A',
        'À' => 'A',
        'Ã' => 'A',
        'Â' => 'A',
        'É' => 'E',
        'Ê' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ú' => 'U',
        'Ü' => 'U',
        'Ç' => 'C'
    );
    return strtr($string, $map);
}

function formatarCPF($valor)
{
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

function enviaEmail($senha_nova, $destino)
{
    $message = "Nova senha para o AD: $senha_nova";
    $message = wordwrap($message, 70);

    $headers = 'From: email@email' . "\r\n" . "Content-Type: text/html; charset=UTF-8";
    $envio = mail($destino, "Solicitação de nova senha para o AD", $message, $headers);
//	echo "Mudou\n";
    header("Location:index.php?mess=2");
}

?>
