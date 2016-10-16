<?php

namespace framework\core;

//require_once (__DIR__ . '/IModel.php');

interface IModel {

    function openConnection();

    function closeConection();

    function getTable();

    function create($data);

    function readAll();

    function read($where);

    function update($data);

    function delete($id);
}
