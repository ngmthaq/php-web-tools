<?php

namespace Core;

use Closure;

class Route
{
    /**
     * Request Method
     */
    public string $_method;

    /**
     * Request Path
     */
    public string $_path;

    /**
     * Request Action
     */
    public Closure $_action;

    /**
     * @param string $method
     * @return $this
     */
    public function method(string $method): Route
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function path(string $path): Route
    {
        $this->_path = $path;
        return $this;
    }

    /**
     * @param Closure $action
     * @return $this
     */
    public function action(Closure $action): Route
    {
        $this->_action = $action;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMatching(): bool
    {
        $path = Server::resolvePath();
        $method = Server::resolveMethod();
        $method_cmp = strcmp(strtolower($method), strtolower($this->_method));
        if ($this->isNeedRegex()) {
            $regex_path = $this->regexPath();
            $preg_match = preg_match($regex_path, $path);
            return $preg_match === 1 && $method_cmp  === 0;
        } else {
            $path_cmp = strcmp(strtolower($path), strtolower($this->_path));
            return $path_cmp === 0 && $method_cmp  === 0;
        }
    }

    /**
     * @return Closure
     */
    public function resolvePath(): Closure
    {
        return $this->_action;
    }

    /**
     * @return array
     */
    public function resolveParams(): array
    {
        $matches = [];
        $pattern = $this->regexPath();
        $path = Server::resolvePath();
        preg_match_all($pattern, $path, $matches);
        $full_params = array_map(fn ($match) =>  $match[0], $matches);
        $params = array_filter($full_params, fn ($_, $index) => $index > 0, ARRAY_FILTER_USE_BOTH);
        return array_values($params);
    }

    /**
     * @return bool
     */
    public function isNeedRegex(): bool
    {
        $pattern = '/{\d+}/';
        preg_match_all($pattern, $this->_path, $matches);
        return count($matches[0]) > 0;
    }

    /**
     * @return string
     */
    public function regexPath(): string
    {
        $pattern_1 = '/{\d+}/';
        $pattern_2 = '/';
        $path = preg_replace($pattern_1, '(.+)', $this->_path);
        $regex = str_replace($pattern_2, '\/', $path);
        return "/" . $regex . "/";
    }
}
