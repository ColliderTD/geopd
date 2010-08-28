<?php
function Main() {
	ob_start();
	require_once("config.php");
	$lPage = "Inicio";
	$lAction = "Load";

	if (isset($_GET["Page"]) && !empty($_GET["Page"]))
	$lPage = $_GET["Page"];

	if (isset($_POST["Page"]) && !empty($_POST["Page"]))
	$lPage = $_POST["Page"];

	if (isset($_GET["Action"]) && !empty($_GET["Action"]))
	$lAction = $_GET["Action"];

	if (isset($_POST["Action"]) && !empty($_POST["Action"]))
	$lAction = $_POST["Action"];

	$lController=$lPage.'Con';

	$lControllerPath =  ConFol.$lController.'.php';

	if(is_file($lControllerPath))
	require_once($lControllerPath);
	else
	trigger_error('El controlador no existe - 404 not found',E_USER_NOTICE);

	$lObjController = new $lController($lPage);
	$lObjController ->$lAction();

}
Main();
ob_end_flush();?>