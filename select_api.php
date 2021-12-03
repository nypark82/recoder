<?php
require_once("../config.php");
session_start();
if(isset($_GET["t_id"])){
  $t_id = intval($_GET["t_id"]);
  $u_id = intval($_SESSION["u_id"]);
  $sql = "SELECT s_id, scores.t_id, t_name,score, scores.v_id,v_name, c_day FROM scores ";
  $sql .= " INNER JOIN tests ON tests.t_id = scores.t_id";
  $sql .= " INNER JOIN versions ON versions.v_id = scores.v_id"; 
  $sql .= " WHERE scores.t_id =:t_id AND scores.u_id =:u_id ";
  $sql .= " ORDER BY c_day";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":t_id", $t_id, PDO::PARAM_INT);
  $stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
  $stmt->execute();
}
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($row);
exit();
?>