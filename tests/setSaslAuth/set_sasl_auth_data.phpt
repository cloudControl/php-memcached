--TEST--
set sasl authentification
--FILE--
<?php
$config = parse_ini_file('./tests/setSaslAuth/set_sasl_auth.ini');
if(empty($config)){
    die('To set the authentification data please provide them in the set_sasl_auth.ini file');
}

$server = $config['servers'];
$user = $config['username'];
$password = $config['password'];

$m = new Memcached();
$m->addServer($server, 11211);

$m->set('visitorcount', 0);
$m->increment('visitorcount');
echo sprintf(">%d<\n", $m->get('visitorcount'));

// with authentification
var_dump($m->setOption(Memcached::OPT_BINARY_PROTOCOL, true));
var_dump($m->setSaslAuthData($user, $password));
var_dump($m->configureSasl($user, $password));
var_dump($m->setSaslData($user, $password));

$m->set('private_visitorcount', 0);
$m->increment('private_visitorcount');
echo sprintf(">%d<", $m->get('private_visitorcount'));
?>
--EXPECT--
>0<
bool(true)
bool(true)
bool(true)
bool(true)
>1<
