<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/./vendor/autoload.php';
require __DIR__.'/src/config/db.php';

$app = new \Slim\App;

// 1. Insert a new patient into the database
$app->post('/api/patients/add', function ($request, $response, array $args) {


    $name = $request->getParam('name');

    $age = $request->getParam('age');
    $gender = $request->getParam('gender');
    $occupation = $request->getParam('occupation');
    $marital_status = $request->getParam('marital_status');


    $admission_date = $request->getParam('admission_date');
    $treatment_date = $request->getParam('treatment_date');
    $ICU_admission_date = $request->getParam('ICU_admission_date');
    $discharge_date = $request->getParam('discharge_date');
    $death_date = $request->getParam('death_date');
    $admission_status = $request->getParam('admission_status');
    $ICU_status = $request->getParam('ICU_status');
    $clinical_death_status = $request->getParam('clinical_death_status');
    $discharge_status = $request->getParam('discharge_status');
    
    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "INSERT INTO patients () VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $pdo->prepare($sql)->execute([]);

        // $response->getBody()->write('{"msg": {"resp": Patient' . $name . 'has been added to the patient's list}}');
        echo '{"msg": {"text": Patient ' . $name . ' has been added to the patient\'s list}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});

// 2. GET All Patients
$app->get('/api/patients', function ($request, $response, $args) {
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
$app->get('/api/patients/{id}', function ($request, $response, array $args) {
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
// 4. Update all patient

$app->put('/api/patients/update/profile/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');

    $age = $request->getParam('age');
    $gender = $request->getParam('gender');
    $occupation = $request->getParam('occupation');
    $marital_status = $request->getParam('marital_status');

    $name = $request->getParam('name');
    $admission_date = $request->getParam('admission_date');
    $treatment_date = $request->getParam('treatment_date');
    $ICU_admission_date = $request->getParam('ICU_admission_date');
    $discharge_date = $request->getParam('discharge_date');
    $death_date = $request->getParam('death_date');
    $admission_status = $request->getParam('admission_status');
    $ICU_status = $request->getParam('ICU_status');
    $clinical_death_status = $request->getParam('clinical_death_status');
    $discharge_status = $request->getParam('discharge_status');

    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "UPDATE patients SET name = ?, age=?, gender=?, occupation=?, marital-status =?, admission_date = ?, treatment_date= ?, ICU_admission_date = ? , discharge_date = ?, death_date = ?, admission_status = ?, ICU_status = ?, clinical_death_status = ?, discharge_status=? WHERE id=? ";

        $pdo->prepare($sql)->execute([$name, $age, $gender, $occupation, $marital_status, $admission_date, $treatment_date, $ICU_admission_date, $discharge_date, $death_date, $admission_status, $ICU_status, $clinical_death_status, $discharge_status, $id]);

        echo '{"notice": {"text": Patient ' . $name . ' has been updated successfully}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});

// 5. Update patient PROFILE by ID
$app->put('/api/patients/update/profile/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');

    $name = $request->getParam('name');
    $age = $request->getParam('age');
    $gender = $request->getParam('gender');
    $occupation = $request->getParam('occupation');
    $marital_status = $request->getParam('marital_status');

    

    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "UPDATE patients SET name = ?, age=?, gender=?, occupation=?, marital-status =?WHERE id=? ";

        $pdo->prepare($sql)->execute([$name, $age, $gender, $occupation, $marital_status, $id]);

        echo '{"notice": {"text": Patient ' . $name . ' has been updated successfully}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});
            

            // 6. Update patient status by ID

            $app->put('/api/patients/update/status/{id}', function ($request, $response, array $args) {
                $id = $request->getAttribute('id');
                
                $admission_status = $request->getParam('admission_status');
                $ICU_status = $request->getParam('ICU_status');
                $clinical_death_status = $request->getParam('clinical_death_status');
                $discharge_status = $request->getParam('discharge_status');
            
                try {
                    $db = new db();
                    $pdo = $db->connect();
                    $sql = "UPDATE patients SET admission_status = ?, ICU_status = ?, clinical_death_status = ?, discharge_status=? WHERE id=? ";
            
                    $pdo->prepare($sql)->execute([$admission_status, $ICU_status, $clinical_death_status, $discharge_status, $id]);
            
                    echo '{"notice": {"text": Patient ' . $name . ' has been updated successfully}}';
                    $pdo = null;
                } catch (\PDOException $e) {
                    echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
                }
            });

            
            // 7. Delete patient by ID
            $app->delete('/api/patients/delete/{id}', function ($request, $response, array $args) {
                $id = $request->getAttribute('id');
                try {
                    $db = new db();
                    $pdo = $db->connect();
                    $sql = "DELETE FROM patients WHERE id=? ";
            
                    $pdo->prepare($sql)->execute([$id]); //last is id
                    $pdo = null;
            
                    echo '{"notice": {"text": User with ' . $id . ' has been deleted successfully}}';
                } catch (\PDOException $e) {
                    echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
                }
            });
            
$app->run();