<?php
require_once("../config.php");
session_start();
$u_id = intval($_SESSION["u_id"]);
$t_id = intval($_GET["t_id"]);
if($t_id == 99999){
  $sql = "SELECT s_id, scores.t_id, t_name, scores.v_id, v_name, score,c_day,created FROM scores, tests,versions";
  $sql .= " WHERE scores.t_id=tests.t_id AND u_id=:u_id AND scores.v_id=versions.v_id";
  $sql .= " ORDER BY c_day DESC"; 
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
}else{
  $sql = "SELECT s_id, scores.t_id, t_name, scores.v_id, v_name, score,c_day,created FROM scores, tests, versions";
  $sql .= " WHERE scores.t_id=tests.t_id AND scores.v_id=versions.v_id";
  $sql .= " AND u_id=:u_id AND scores.t_id=:t_id ORDER BY c_day DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
  $stmt->bindValue(":t_id", $t_id, PDO::PARAM_INT);
}
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($row);
exit();
?>