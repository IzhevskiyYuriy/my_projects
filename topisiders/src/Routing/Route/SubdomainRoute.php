<?php

namespace App\Routing\Route;


use Cake\Http\ServerRequestFactory as Request;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;

class SubdomainRoute extends Route
{
    /**
     * @param string $url
     * @param string $method
     * @return bool|array
     */
    public function parse($url, $method = '')
    {
        list($prefix) = $this->_getPrefixAndHost();
        if (!$this->_checkPrefix($prefix)) {
            return false;
        }
        return parent::parse($url, $method);
    }

    /**
     * @param array $url
     * @param array $context
     * @return bool|array
     */
    public function match(array $url, array $context = [])
    {
        if (!isset($url['prefix'])) {
            $url['prefix'] = null;
        }
        if (!$this->_checkPrefix($url['prefix'])) {
            return false;
        }
        list($prefix, $host) = $this->_getPrefixAndHost($context);
        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === 'false' ? $host : $url['prefix'] . '.' . $host;
        }

        return parent::match($url, $context);
    }
    /**
     * @param array $context
     * @return array
     */
    private function _getPrefixAndHost(array $context = [])
    {
        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::fromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }

        return $this->getPrefixAndHost($host);
    }
    /**
     * @param string $prefix
     * @return bool
     */
    private function _checkPrefix($prefix)
    {
        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : null;
        return $prefix === $routePrefix;
    }

    /**
     * @param string $host
     * @return array
     */
    public function getPrefixAndHost($host)
    {
        if (empty($host)) {
            return [false, false];
        }
        if (preg_match('/(.*?)\.([^\/]*\..{2,5})/i', $host, $match)) {
            // if (in_array($match[1], $this->getSubdomains())) {
                return [$match[1], $match[2]];
            // } else {
            //     return [false, $match[2]];
            // }
        } else {
            return [false, $host];
        }
    }

}
