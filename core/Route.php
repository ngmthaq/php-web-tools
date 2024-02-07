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
     * Set Method
     */
    public function method(string $method): Route
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * Set Path
     */
    public function path(string $path): Route
    {
        $this->_path = $path;
        return $this;
    }

    /**
     * Set Action
     */
    public function action(Closure $action): Route
    {
        $this->_action = $action;
        return $this;
    }

    /**
     * Check route match with current request
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
     * Resolve Path Action
     */
    public function resolvePath(): Closure
    {
        $action = $this->_action;
        return $action;
    }

    /**
     * Resolve URL Params
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
     * Check if path need convert to regex path
     */
    public function isNeedRegex(): bool
    {
        $pattern = '/{\d+}/';
        preg_match_all($pattern, $this->_path, $matches);
        return count($matches[0]) > 0;
    }

    /**
     * Get Path Regex
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
