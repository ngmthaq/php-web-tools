<?php

namespace App;

use App\Exceptions\AppException;
use App\Exceptions\FailureValidationException;
use App\Exceptions\ForbiddenException;
use App\Providers\AppProvider;
use Core\Debug;
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
            $this->runProviders();
            $this->runMiddlewares();
            $route = Request::getCurrentRoute();
            call_user_func($route->resolvePath());
        } catch (ForbiddenException $th) {
            $trace = isProd() ? [] : $th->getTrace();
            Response::error($th->getCode(), $th->getMessage(), $th->getDetails(), $trace);
        } catch (FailureValidationException $th) {
            $trace = isProd() ? [] : $th->getTrace();
            Response::validationError($th->getMessage(), $th->getDetails(), $trace);
        } catch (AppException $th) {
            $trace = isProd() ? [] : $th->getTrace();
            Response::error($th->getCode(), $th->getMessage(), [], $trace);
        } catch (Throwable $th) {
            $error_message = $th->getMessage() . " (" . $th->getFile() . ":" . $th->getLine() . ")";
            $message = isProd() ? "The server has encountered a situation it does not know how to handle" : $error_message;
            $trace = isProd() ? [] : $th->getTrace();
            $debug_message = $error_message . "\n" . $th->getTraceAsString() . "\n";
            Debug::error($debug_message);
            Response::error(Response::STT_INTERNAL_SERVER_ERROR, $message, [], $trace);
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

    /**
     * Start running providers
     *
     * @return void
     */
    public function runProviders(): void
    {
        $app_configs = require(Dir::configs() . "/app.php");
        $providers = $app_configs["providers"];
        $GLOBALS[AppProvider::GLOBAL_KEY] = [];
        foreach ($providers as $provider) {
            $provider_instance = new $provider;
            $GLOBALS[AppProvider::GLOBAL_KEY][$provider_instance->key] = $provider_instance;
        }
    }
}
