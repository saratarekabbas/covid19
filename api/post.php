<?php

$app->get('/post', function($request, $response){
    return $response->getBody()->write("post works!");
});

// 1. Insert a new patient into the database
$app->post('/patients', function ($request, $response, array $args) {
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
        $sql = "INSERT INTO patients (name,age,gender,occupation,marital_status,admission_date,treatment_date,ICU_admission_date,discharge_date,death_date,admission_status,ICU_status,clinical_death_status,discharge_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $pdo->prepare($sql)->execute([$name, $age, $gender, $occupation, $marital_status, $admission_date, $treatment_date, $ICU_admission_date, $discharge_date, $death_date, $admission_status, $ICU_status, $clinical_death_status, $discharge_status]);

        // $response->getBody()->write('{"msg": {"resp": Patient' . $name . 'has been added to the patient's list}}');
        echo '{"msg": {"text": Patient ' . $name . ' has been added to the patient\'s list}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});