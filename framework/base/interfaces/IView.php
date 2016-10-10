<?php

interface IView {

    function getRootPath();

    function getTitle();

    function getContent();

    function buildUI();
}
