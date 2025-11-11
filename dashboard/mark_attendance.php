<?php require '../config.php'; header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD']!=='POST'){ echo json_encode(['status'=>'error']); exit; }
$id = intval($_POST['id'] ?? 0); $status = $_POST['status'] ?? 'present';
if(!$id){ echo json_encode(['status'=>'error','msg'=>'id required']); exit; }
$u = $pdo->prepare('UPDATE attendance SET status=? WHERE id=?'); $u->execute([$status,$id]);
echo json_encode(['status'=>'ok']);
?>