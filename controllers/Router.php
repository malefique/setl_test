<?php

namespace controllers;

class Router extends Controller
{
    /*protected static $availablePatterns = [
        '/((\/(.*?)|)\/:([a-z0-9_]+)(\/|)?((.*?)+|))+/is'
    ];*/

    private static function getParsedUri()
    {
        return parse_url($_SERVER['REQUEST_URI']);
    }

    private static function getPath()
    {
        return self::getParsedUri()['path']??'';
    }

    private static function getQuery()
    {
        return self::getParsedUri()['query']??'';
    }

    private static function getMethod(){
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    private static function compareParams($params)
    {
        $out = [];
        if($params !== null)
        {
            parse_str(self::getQuery(),$parsedQuery);
            foreach($params as $key => $value)
            {
                if(isset($parsedQuery[$key]))
                {
                    if(gettype($parsedQuery[$key]) === gettype($value))
                        $out[] = $parsedQuery[$key];
                    else {
                        settype($parsedQuery[$key], gettype($value));
                        $out[] = $parsedQuery[$key];
                    }

                }
                else
                   $out[] = $value;
            }
        }
        return $out;
    }

    public static function get($action, $handler, $params = null)
    {
        $params = self::compareParams($params);
        $actionWithVariables = '/'.preg_replace(array('/:([a-z0-9_]+)/i', '/\//i'), array('([a-z0-9_]+)+', '\/'), $action).'/i';
        if($action === self::getPath() && self::getMethod() === 'GET')
        {
            list($controller,$method) = explode('@',$handler);
            $rc = (new \ReflectionClass(__NAMESPACE__.'\\'.$controller))->newInstanceWithoutConstructor();
            $rc->{$method}(...$params);
        }
        elseif(preg_match_all($actionWithVariables, self::getPath(), $matches) === 1 && self::getMethod() === 'GET'){
            preg_match_all('/:([a-z0-9_]+)/i',$action,$paramKeys);
            if(!empty($paramKeys[1])){
                list($controller,$method) = explode('@',$handler);
                $rc = (new \ReflectionClass(__NAMESPACE__.'\\'.$controller))->newInstanceWithoutConstructor();
                $rc->{$method}(...$matches[1]);
            }
        }
    }

    public static function post($action, $handler, $params = null)
    {
        if($action === self::getPath() && self::getMethod() === 'POST')
        {
            list($controller,$method) = explode('@',$handler);
            $rc = (new \ReflectionClass(__NAMESPACE__.'\\'.$controller))->newInstanceWithoutConstructor();
            $rc->{$method}($_POST);
        }
    }
}