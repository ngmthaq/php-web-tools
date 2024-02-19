<?php

namespace App;

use App\Exceptions\AppException;
use App\Exceptions\ForbiddenException;
use Core\Dir;
use Core\Request;
use Core\Response;
use Exception;
use Throwable;

class Kernel
{
    /**
     * Start running application
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        try {
            $this->runMiddlewares();
            $route = Request::getCurrentRoute();
            call_user_func($route->resolvePath());
        } catch (ForbiddenException $th) {
            Response::error($th->getCode(), $th->getMessage(), $th->getDetails());
        } catch (AppException $th) {
            Response::error($th->getCode(), $th->getMessage());
        } catch (Throwable $th) {
            $message = isProd() ? "The server has encountered a situation it does not know how to handle" : $th->getMessage();
            $details = isProd() ? [] : $th->getTrace();
            Response::error(Response::STT_INTERNAL_SERVER_ERROR, $message, $details);
        }
    }

    /**
     * Start running global middlewares
     *
     * @return void
     */
    public function runMiddlewares(): void
    {
        $app_configs = require(Dir::configs() . "/app.php");
        $global_middlewares = $app_configs["middlewares"];
        foreach ($global_middlewares as $middleware) {
            call_user_func_array([new $middleware, "handle"], []);
        }
    }
}
