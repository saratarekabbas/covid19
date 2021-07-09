<?php

$app->get('/put', function($request, $response){
    return $response->getBody()->write("put works!");
});

// 4. Update all patient

// $app->put('/patients/all/{id}', function ($request, $response, array $args) {
//     $id = $request->getAttribute('id');

//     $age = $request->getParam('age');
//     $gender = $request->getParam('gender');
//     $occupation = $request->getParam('occupation');
//     $marital_status = $request->getParam('marital_status');

//     $name = $request->getParam('name');
//     $admission_date = $request->getParam('admission_date');
//     $treatment_date = $request->getParam('treatment_date');
//     $ICU_admission_date = $request->getParam('ICU_admission_date');
//     $discharge_date = $request->getParam('discharge_date');
//     $death_date = $request->getParam('death_date');
//     $admission_status = $request->getParam('admission_status');
//     $ICU_status = $request->getParam('ICU_status');
//     $clinical_death_status = $request->getParam('clinical_death_status');
//     $discharge_status = $request->getParam('discharge_status');

//     try {
//         $db = new db();
//         $pdo = $db->connect();
//         $sql = "UPDATE patients SET name = ?, age=?, gender=?, occupation=?, marital_status =?, admission_date = ?, treatment_date= ?, ICU_admission_date = ? , discharge_date = ?, death_date = ?, admission_status = ?, ICU_status = ?, clinical_death_status = ?, discharge_status=? WHERE id=? ";

//         $pdo->prepare($sql)->execute([$name, $age, $gender, $occupation, $marital_status, $admission_date, $treatment_date, $ICU_admission_date, $discharge_date, $death_date, $admission_status, $ICU_status, $clinical_death_status, $discharge_status, $id]);

//         echo '{"notice": {"text": Patient ' . $name . ' has been updated successfully}}';
//         $pdo = null;
//     } catch (\PDOException $e) {
//         echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
//     }
// });

// 5. Update patient PROFILE by ID
$app->put('/patients/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');

    $name = $request->getParam('name');
    $age = $request->getParam('age');
    $gender = $request->getParam('gender');
    $occupation = $request->getParam('occupation');
    $marital_status = $request->getParam('marital_status');

    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "UPDATE patients SET name = ?, age=?, gender=?, occupation=?, marital_status =? WHERE id=? ";

        $pdo->prepare($sql)->execute([$name, $age, $gender, $occupation, $marital_status, $id]);

        echo '{"notice": {"text": Patient ' . $name . '\'s details have been updated successfully}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});

// 6. Update patient status by ID

$app->put('/patients/status/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');
    $name = $request->getParam('name');

    $admission_status = $request->getParam('admission_status');
    $ICU_status = $request->getParam('ICU_status');
    $clinical_death_status = $request->getParam('clinical_death_status');
    $discharge_status = $request->getParam('discharge_status');

    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "UPDATE patients SET admission_status = ?, ICU_status = ?, clinical_death_status = ?, discharge_status=? WHERE id=? ";

        $pdo->prepare($sql)->execute([$admission_status, $ICU_status, $clinical_death_status, $discharge_status, $id]);

        echo '{"notice": {"text": Patient ' . $name . '\'s status have been updated successfully}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});