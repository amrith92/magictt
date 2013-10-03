<?php

namespace Library\Controller;

interface FrontControllerInterface {

	public function setBasepath($path);

	public function getBasepath();

	public function parseUri();

	public function setController($controller);

	public function setAction($action);

	public function setParameters(array $params);

	public function run();
}
