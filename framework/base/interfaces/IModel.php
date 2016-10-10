<?php

interface IModel {

    function open_connection();

    function close_conection();

    function create($data);

    function readAll();

    function read($where);

    function update($data);

    function delete($data);
}
