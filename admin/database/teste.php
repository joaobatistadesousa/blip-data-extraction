<?php
include_once 'ClientDao.php';

$client= new ClientDao();
echo json_encode($client->findMany());
?>