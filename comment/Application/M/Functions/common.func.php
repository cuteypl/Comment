<?php
/**
 * 弹出提示信息并且跳ת
* @param string $mes
* @param string $url
*/
function alertMes($mes,$url){
    echo "<script>
    alert('{$mes}');
    window.location.href='{$url}';
    </script>";
	die;
}
function alertMes_blank($mes,$url){
    echo "<script>
    alert('{$mes}');
    window.open('{$url}');
    </script>";
    die;
}
?>