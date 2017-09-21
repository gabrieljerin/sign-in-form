<?php

function save_data($conn, $table, $data, $action = "insert", $parameters = "", $whereIndex = "") {
    reset($data);
    if ($action == 'insert') {
        $query = 'INSERT INTO ' . $table . ' (' . join(', ', array_keys($data)) . ') VALUES (';
        reset($data);
        foreach ($data as $value) {
            switch ((string) $value) {
                case 'now()':
                    $query .= 'NOW(), ';
                    break;
                case 'null':
                    $query .= 'NULL, ';
                    break;
                default:
                    $query .= '\'' . $value . '\', ';
                    break;
            }
        }
        $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
        $query = 'UPDATE ' . $table . ' SET ';
        foreach ($data as $columns => $value) {
            switch ((string) $value) {
                case 'now()':
                    $query .= $columns . ' = NOW(), ';
                    break;
                case 'null':
                    $query .= $columns .= ' = NULL, ';
                    break;
                default:
                    $query .= $columns . ' = \'' . $value . '\', ';
                    break;
            }
        }
        if ($parameters !== '' && $whereIndex !== '')
            $query = substr($query, 0, -2) . ' WHERE' . ' ' . $whereIndex . '=' . $parameters;
    }
    mysqli_query($conn, $query);
    if ($action == 'insert') {
        return mysqli_insert_id($conn);
    }
}

function get_data($conn, $table, $index = "", $id = "") {
    $data = array();
    if ($id != "" && $index != "") {
        $query = "select * from" . " " . $table . " " . "where" . " " . $index . "=" . $id;
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        $query = "select * from" . " " . $table;
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}
function get_all_data_order_by_desc($conn, $table, $index = ""){
    $data = array();
    if ($index != "") {
        $query = "select * from" . " " . $table . " " . "order by" . " " . $index . " " . "DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}
function delete_data($conn, $table, $index = "", $id = "") {
    $query = "delete from" . " " . $table . " " . "where" . " " . $index . "=" . $id;
    return $result = mysqli_query($conn, $query);
}
?>

