<?php

namespace Core;

class Route
{
    /**
     * Request Method
     */
    public string $method;

    /**
     * Request Path
     */
    public string $path;

    /**
     * Request Action
     */
    public mixed $action;

    public function __construct(string $method, string $path, mixed $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * Check route match with current request
     */
    public function isMatching()
    {
        $path = Server::resolvePath();
        $method = Server::resolveMethod();
        $method_cmp = strcmp(strtolower($method), strtolower($this->method));
        if ($this->isNeedRegex()) {
            $regex_path = $this->regexPath();
            $preg_match = preg_match($regex_path, $path);
            return $preg_match === 1 && $method_cmp  === 0;
        } else {
            $path_cmp = strcmp(strtolower($path), strtolower($this->path));
            return $path_cmp === 0 && $method_cmp  === 0;
        }
    }

    /**
     * Resolve Path Action
     */
    public function resolvePath()
    {
        $pattern = $this->regexPath();
        $path = Server::resolvePath();
        $action = $this->action;
        if ($this->isNeedRegex()) {
            preg_match_all($pattern, $path, $matches);
            $full_params = array_map(fn ($match) =>  $match[0], $matches);
            $params = array_filter($full_params, fn ($_, $index) => $index > 0, ARRAY_FILTER_USE_BOTH);
            $action(array_values($params));
        } else {
            $action();
        }
    }

    /**
     * Check if path need convert to regex path
     */
    public function isNeedRegex()
    {
        $pattern = '/{\d+}/';
        preg_match_all($pattern, $this->path, $matches);
        return count($matches[0]) > 0;
    }

    /**
     * Get Path Regex
     */
    public function regexPath()
    {
        $pattern_1 = '/{\d+}/';
        $pattern_2 = '/';
        $path = preg_replace($pattern_1, '(.+)', $this->path);
        $regex = str_replace($pattern_2, '\/', $path);
        return "/" . $regex . "/";
    }
}
