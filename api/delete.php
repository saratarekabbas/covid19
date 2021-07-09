<?php

// 7. Delete patient by ID
$app->delete('/delete/{id}', function ($request, $response, array $args) {
    $id = $request->getAttribute('id');
    try {
        $db = new db();
        $pdo = $db->connect();
        $sql = "DELETE FROM patients WHERE id=? ";

        $pdo->prepare($sql)->execute([$id]); //last is id
        $pdo = null;

        echo '{"notice": {"text": Patient with ' . $id . ' has been deleted successfully}}';
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}'; //catching error in DB
    }
});