<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/incidents', 'getIncident');
$app->get('/incidents/:id',	'getIncident');
/* $app->get('/incidents/search/:query', 'findByName'); */
$app->post('/incidents', 'saveInci');
$app->put('/incidents/:id', 'updateIncident');
//$app->delete('/wines/:id',	'deleteWine');

$app->run();

function getIncident() {
	$sql = "select * FROM incident ORDER BY name";
	try {
		$db    = getConnection();
		$stmt  = $db->query($sql);
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db    = null;
		// echo '{"wine": ' . json_encode($wines) . '}';
		echo json_encode($incidents);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getIncident($id) {
	$sql = "SELECT * FROM incident WHERE id=:id";
	try {
		$db   = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$wine = $stmt->fetchObject();
		$db   = null;
		echo json_encode($incident);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function saveInci() {
	// error_log('saveInci\n', 3, '/var/tmp/php.log');
	$request = Slim::getInstance()->request();
	$incident    = json_decode($request->getBody());
	$sql     = "INSERT INTO incident (name, addr, direction, type, notes, picture) VALUES (:name, :addr, :direction, :type, :notes, :picture)";
	try {
		$db   = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $incident->name);
		$stmt->bindParam("addr", $incident->addr);
		$stmt->bindParam("direction", $incident->direction);
		$stmt->bindParam("type", $incident->type);
		$stmt->bindParam("notes", $incident->notes);
		$stmt->bindParam("picture", $incident->picture);
		$stmt->execute();
		$incident->id = $db->lastInsertId();
		$db       = null;
		echo json_encode($incident);
	} catch(PDOException $e) {
		// error_log($e->getMessage(), 3, '/var/tmp/php.log');
		// echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateIncident($id) {
	$request = Slim::getInstance()->request();
	$body    = $request->getBody();
	$incident    = json_decode($body);
	$sql     = "UPDATE incident SET name=:name, addr=:addr, type=:type, notes=:notes, picture=:picture WHERE id=:id";
	try {
		$db   = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $incident->name);
		$stmt->bindParam("addr", $incident->addr);
		$stmt->bindParam("direction", $incident->direction);
		$stmt->bindParam("type", $incident->type);
		$stmt->bindParam("notes", $incident->notes);
		$stmt->bindParam("picture", $incident->picture);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db   = null;
		echo json_encode($incident);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

/* function deleteIncident($id) {
	$sql = "DELETE FROM wine WHERE id=:id";
	try {
		$db   = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db   = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function findByName($query) {
	$sql = "SELECT * FROM wine WHERE UPPER(name) LIKE :query ORDER BY name";
	try {
		$db    = getConnection();
		$stmt  = $db->prepare($sql);
		$query = "%".$query."%";
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db    = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
} */

function getConnection() {
	$dbhost ="127.0.0.1";
	$dbuser ="root";
	$dbpass ="root";
	$dbname ="reports";
	$dbh    = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}