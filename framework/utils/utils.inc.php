<?php

function array_to_mysql($link, $data) {
    $result = array();
    $sanitized_data = array();
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $sanitized_data[$key] = "'" . mysqli_real_escape_string($link, $value) . "'";
        } else {
            $sanitized_data[$key] = mysqli_real_escape_string($link, $value);
        }
    }
    $fields = implode(', ', array_keys($sanitized_data));
    $values = implode(', ', $sanitized_data);
    $result["fields"] = $fields;
    $result["values"] = $values;
    return $result;
}
