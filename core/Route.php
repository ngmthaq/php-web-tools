<?php

namespace Core;

use Closure;

class Route
{
    public string $_method;
    public string $_path;
    public Closure $_action;
    public bool $_is_skip_x_csrf_verification = false;

    /**
     * Set method
     *
     * @param string $method
     * @return $this
     */
    public function method(string $method): Route
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return $this
     */
    public function path(string $path): Route
    {
        $this->_path = $path;
        return $this;
    }

    /**
     * Set action
     *
     * @param Closure $action
     * @return $this
     */
    public function action(Closure $action): Route
    {
        $this->_action = $action;
        return $this;
    }

    /**
     * Configs X-CSRF-Token
     *
     * @param bool $is_skip
     * @return $this
     */
    public function skipXSRF(bool $is_skip = true): Route
    {
        $this->_is_skip_x_csrf_verification = $is_skip;
        return $this;
    }

    /**
     * Check if server can skip check X-CSRF-Token
     *
     * @return bool
     */
    public function isSkipXSRF(): bool
    {
        return $this->_is_skip_x_csrf_verification;
    }

    /**
     * Check matching route
     *
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
            return $preg_match === 1 && $method_cmp === 0;
        } else {
            $path_cmp = strcmp(strtolower($path), strtolower($this->_path));
            return $path_cmp === 0 && $method_cmp === 0;
        }
    }

    /**
     * Resolve path and get action
     *
     * @return Closure
     */
    public function resolvePath(): Closure
    {
        return $this->_action;
    }

    /**
     * Check if path need convert to regex format
     *
     * @return bool
     */
    public function isNeedRegex(): bool
    {
        $pattern = '/{\d+}/';
        preg_match_all($pattern, $this->_path, $matches);
        return count($matches[0]) > 0;
    }

    /**
     * Get regex path
     *
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

    /**
     * Resolve params from URL
     *
     * @return array
     */
    public function resolveParams(): array
    {
        $matches = [];
        $pattern = $this->regexPath();
        $path = Server::resolvePath();
        preg_match_all($pattern, $path, $matches);
        $full_params = array_map(fn($match) => $match[0], $matches);
        $params = array_filter($full_params, fn($_, $index) => $index > 0, ARRAY_FILTER_USE_BOTH);
        return array_values($params);
    }
}
