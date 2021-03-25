<?php
$infoSellers = $pdo->query("SELECT * FROM sellers")->fetchAll();
$infoClients = $pdo->query("SELECT * FROM clients")->fetchAll();
$infoPages = $pdo->query("SELECT * FROM pages")->fetchAll();
$infoVisits = $pdo->query("SELECT * FROM visits")->fetchAll();
$infoUsers = $pdo->query("SELECT * FROM users")->fetchAll();


if(isset($_POST['cadastrar_vendedor'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("INSERT INTO sellers (name, seller_number) VALUES (?,?)");
            $sql->execute([$_POST['seller_name'],$_POST['seller_number']]);
            header("Location:index.php?tab=$current_tab&subtab=lista_de_vendedores");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['editar_vendedor'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("UPDATE sellers SET name = ?, seller_number = ? WHERE id = ?");
            $sql->execute(array($_POST['seller_name'],$_POST['seller_number'],$_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_vendedores");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['excluir_vendedor'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("DELETE FROM sellers WHERE id = ?");
            $sql->execute(array($_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_vendedores");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}

if(isset($_POST['cadastrar_cliente'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("INSERT INTO clients (name, city, address, phone, contact) VALUES (?,?,?,?,?)");
            $sql->execute([$_POST['client'],$_POST['city'],$_POST['address'],$_POST['phone'],$_POST['contact']]);
            header("Location:index.php?tab=$current_tab&subtab=lista_de_clientes");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['editar_cliente'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("UPDATE clients SET name = ?, city = ?, address = ?, phone = ?,contact = ? WHERE id = ?");
            $sql->execute(array($_POST['client'],$_POST['city'],$_POST['address'],$_POST['phone'],$_POST['contact'],$_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_clientes");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['excluir_cliente'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("DELETE FROM clients WHERE id = ?");
            $sql->execute(array($_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_clientes");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}

if(isset($_POST['cadastrar_paginacaderno'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("INSERT INTO pages (name) VALUES (?)");
            $sql->execute([$_POST['name']]);
            header("Location:index.php?tab=$current_tab&subtab=lista_de_pagina_e_caderno");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['editar_paginacaderno'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("UPDATE pages SET name = ? WHERE id = ?");
            $sql->execute(array($_POST['name'],$_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_pagina_e_caderno");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['excluir_paginacaderno'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("DELETE FROM pages WHERE id = ?");
            $sql->execute(array($_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=lista_de_pagina_e_caderno");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}

if(isset($_POST['cadastrar_visita'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("INSERT INTO visits (`date`,seller,client,contact,page,type,phone,result) VALUES (?,?,?,?,?,?,?,?)");
            $sql->execute([$_POST['date'],$_POST['seller'],$_POST['client'],$_POST['contact'],$_POST['page'],$_POST['type'],$_POST['phone'],$_POST['result']]);
            header("Location:index.php?tab=$current_tab&subtab=ultimas_visitas_cadastradas");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}

if(isset($_POST['editar_visita'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("UPDATE visits SET `date` = ?,seller = ?,client =?,contact = ?,page = ?,type = ?,phone = ?,result = ? WHERE id = ?");
            $sql->execute(array($_POST['date'],$_POST['seller'],$_POST['client'],$_POST['contact'],$_POST['page'],$_POST['type'],$_POST['phone'],$_POST['result'],$_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=ultimas_visitas_cadastradas");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}
if(isset($_POST['excluir_visita'])){
      if ($_SESSION['level'] != 1){
            $sql = $pdo->prepare("DELETE FROM visits WHERE id = ?");
            $sql->execute(array($_POST['id']));
            header("Location:index.php?tab=$current_tab&subtab=ultimas_visitas_cadastradas");
      }else{
            echo '<p class="warning error">Você não tem permissão para fazer nenhuma alteração ou cadastro</p>';
      }
      
}

if(isset($_POST['cadastrar_usuario'])){
      $name = $_POST['name'];
      $user = $_POST['user'];
      $password = $_POST['password'];
      $level = $_POST['level'];
      $encrypted = password_hash($password, PASSWORD_DEFAULT);
      $sql = $pdo->prepare("INSERT INTO users VALUES (?,?,?,?,?)");
      $sql->execute([null,$name,$user,$encrypted,$level]);
      header("Location:index.php?tab=$current_tab&subtab=gerenciamento_de_usuarios");
}
if(isset($_POST['editar_usuario'])){
      if($_POST['password'] != ""){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      }else{
            $password = $_POST['old_password'];
      }
      $sql = $pdo->prepare("UPDATE users SET name = ?, user = ?, password =?,level = ? WHERE id = ?");
      $sql->execute(array($_POST['name'],$_POST['user'],$password,$_POST['level'],$_POST['id']));
      header("Location:index.php?tab=$current_tab&subtab=gerenciamento_de_usuarios");
}
if(isset($_POST['excluir_usuario'])){
      $sql = $pdo->prepare("DELETE FROM users WHERE id = ?");
      $sql->execute(array($_POST['id']));
      header("Location:index.php?tab=$current_tab&subtab=gerenciamento_de_usuarios");
}

if(isset($_POST['editar_usuario_perfil'])){
      if($_POST['password'] != ""){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      }else{
            $password = $_POST['old_password'];
      }
      $sql = $pdo->prepare("UPDATE users SET name = ?, user = ?, password =? WHERE id = ?");
      $sql->execute(array($_POST['name'],$_POST['user'],$password,$_POST['id']));
      $_SESSION['name'] = $_POST['name'];
      header("Location:index.php");
}