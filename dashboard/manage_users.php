<?php require '../config.php'; if(!isset($_SESSION['admin'])) header('Location: ../login.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Manage Users</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body class="app">
<?php include 'nav.php'; ?>
<main class="content">
  <div class="card">
    <h2>Manage Users</h2>
    <form id="userForm">
      <input id="card_uid" placeholder="Card UID">
      <input id="name" placeholder="Name">
      <input id="department" placeholder="Department">
      <div class="actions">
        <button type="button" class="btn" onclick="addUser()">Add / Update</button>
        <button type="button" class="btn danger" onclick="deleteUser()">Delete</button>
      </div>
    </form>
    <hr>
    <h3>Existing Users</h3>
    <table id="usersTbl">
      <thead><tr><th>ID</th><th>UID</th><th>Name</th><th>Dept</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
</main>

<script>
async function load() {
  const res = await fetch('get_users.php');
  const j = await res.json();
  const t = document.querySelector('#usersTbl tbody');
  t.innerHTML = '';
  j.forEach(u => {
    let r = document.createElement('tr');
    r.innerHTML = `<td>${u.id}</td><td>${u.card_uid}</td><td>${u.name}</td><td>${u.department}</td>`;
    t.appendChild(r);
  });
}

async function addUser() {
  const data = new URLSearchParams();
  data.append('card_uid', document.getElementById('card_uid').value);
  data.append('name', document.getElementById('name').value);
  data.append('department', document.getElementById('department').value);
  
  const res = await fetch('add_user.php', { method: 'POST', body: data });
  const json = await res.json();
  alert(json.msg);
  load();
}

async function deleteUser() {
  const uid = document.getElementById('card_uid').value.trim();
  if (!uid) return alert('Please enter Card UID to delete!');
  
  if (!confirm('Are you sure you want to delete this user?')) return;
  
  const data = new URLSearchParams();
  data.append('card_uid', uid);
  
  const res = await fetch('delete_user.php', { method: 'POST', body: data });
  const json = await res.json();
  
  alert(json.msg);
  
  document.getElementById('card_uid').value = '';
  document.getElementById('name').value = '';
  document.getElementById('department').value = '';
  
  load();
}

window.addEventListener('DOMContentLoaded', load);
</script>
</body>
</html>
