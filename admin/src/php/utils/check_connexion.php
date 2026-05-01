<?php

if (!isset($_SESSION['admin'])) {
    header('Location: index_.php');
    exit;
}
