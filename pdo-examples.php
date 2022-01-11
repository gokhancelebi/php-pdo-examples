<?php

# pdo database connection
$pdo = new PDO('mysql:host=localhost;dbname=login_register', 'root', '');

# pdo query to count table and get the number of rows
function num_rows($table, $where = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($where)) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = '$value'";
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->rowCount();
}

# pdo insert to database query function

function db_insert($table, $data)
{
    global $pdo;
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i > 0) {
            $sql .= ", ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);

    # return inserted id
    if ($query->execute()) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

# pdo update to database query function
function db_update($table, $data, $where)
{
    global $pdo;
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i > 0) {
            $sql .= ", ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $sql .= " WHERE ";
    $i = 0;
    foreach ($where as $key => $value) {
        if ($i > 0) {
            $sql .= " AND ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);
    $query->execute();
}

# pdo delete to database query function
function db_delete($table, $where)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE ";
    $i = 0;
    foreach ($where as $key => $value) {
        if ($i > 0) {
            $sql .= " AND ";
        }
        $sql .= "$key = '$value'";
        $i++;
    }
    $query = $pdo->prepare($sql);
    $query->execute();
}