--TEST--
upscaledb - insert, erase, lookup w/ database functions
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php

include "upscaledb.inc";
cleanup_upscaledb_on_shutdown();

$path = dirname(__FILE__) . '/upscaledb-basic.test-db';
$env = new Upscaledb();
var_dump($env->create($path));

$params = array(
    UPS_PARAM_KEY_TYPE  => UPS_TYPE_UINT32
);
var_dump($db = $env->create_db(1, 0, $params));

var_dump($db->insert(null, 1, "record1"));
var_dump($db->insert(null, 2, "record2"));
var_dump($db->insert(null, 3, "record3"));
var_dump($db->insert(null, 4, "record4"));
var_dump($db->insert(null, 5, "record5"));

var_dump($r = $env->select_range("COUNT(\$key) FROM DATABASE 1"));
var_dump($r->get_row_count());
var_dump($r->get_key_type());
var_dump($r->get_record_type());
var_dump($r->get_key(0));
var_dump($r->get_record(0));
var_dump($r->get_key(1));
var_dump($r->get_record(1));
var_dump($r->close());
?>
--EXPECTF--
int(0)
object(UpscaledbDatabase)#2 (0) {
}
int(0)
int(0)
int(0)
int(0)
int(0)
object(UpscaledbResult)#3 (0) {
}
int(1)
int(0)
int(9)
string(6) "COUNT "
int(5)
NULL
NULL
int(0)
