<?php
$app->get('/get', function($request, $response){
    return $response->getBody()->write("get works!");
});

// 2. GET All Patients
$app->get('/patients', function ($request, $response, $args) {
    $sql = "SELECT * FROM patients";

    try {
        $db = new db();
        $pdo = $db->connect();

        // getting pdo query
        $statement = $pdo->query($sql);
        $patients = $statement->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;

        echo json_encode($patients);
    } catch (\PDOException $e) {
        echo '{"error": {"resp": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});

// 3. GET patient by ID
$app->get('/patients/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM patients where id = $id"; //select the ID
    try {
        $db = new db();
        $pdo = $db->connect();
        // getting pdo query
        $statement = $pdo->query($sql);
        $patients = $statement->fetchAll(PDO::FETCH_OBJ);

        $pdo = null;

        echo json_encode($patients);
    } catch (\PDOException $e) {
        echo '{"error": {"resp": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});