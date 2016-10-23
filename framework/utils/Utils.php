<?php

namespace framework\utils;

final class Utils {

    final static function arrayToInsertQuery($link, $data) {
        $result = array();
        $result["fields"] = Utils::arrayKeysToString($link, $data);
        $result["values"] = Utils::arrayValuesToStringTyped($link, $data);
        return $result;
    }

    final static function arrayToUpdateQuery($link, $data) {
        $values = array();
        foreach ($data as $key => $value) {
            if ($key != "id") {
                $values[$key] = $value;
            }
        }

        $result = array();
        $result["id"] = $data["id"];
        $result["values"] = Utils::arrayToString($link, $values);
        return $result;
    }

    final static function arrayToString($link, $data) {
        $sanitized_data = Utils::advancedSanitizeArray($link, $data);
        $values = array();
        foreach ($sanitized_data as $key => $value) {
            array_push($values, $key . " = " . $value);
        }
        $array_string = implode(", ", $values);
        return $array_string;
    }

    final static function arrayKeysToString($link, $data) {
        $keys = implode(', ', array_keys(Utils::advancedSanitizeArray($link, $data)));
        return $keys;
    }

    final static function arrayValuesToStringTyped($link, $data) {
        $values = implode(', ', Utils::advancedSanitizeArray($link, $data));
        return $values;
    }

    final static function arrayValuesToString($link, $data) {
        $values = implode(', ', Utils::simpleSanitizeArray($link, $data));
        return $values;
    }

    final static function advancedSanitizeArray($link, $data) {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitized_data[$key] = "'" . mysqli_real_escape_string($link, trim($value)) . "'";
            } else {
                $sanitized_data[$key] = mysqli_real_escape_string($link, trim($value));
            }
        }
        return $sanitized_data;
    }

    final static function simpleSanitizeArray($link, $data) {
        $sanitized_data = array();
        foreach ($data as $key => $value) {
            $sanitized_data[$key] = mysqli_real_escape_string($link, trim($value));
        }
        return $sanitized_data;
    }

}
