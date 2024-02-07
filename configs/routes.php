<?php

/**
 * Application Route List
 */

use Core\Dir;

$web_routes = require(Dir::routes() . "/web.php");

return array_merge($web_routes);
