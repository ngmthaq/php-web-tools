<?php

/**
 * Application Route List
 */

use Core\Dir;

$web_routes = require_once(Dir::routes() . "/web.php");

return array_merge($web_routes);
