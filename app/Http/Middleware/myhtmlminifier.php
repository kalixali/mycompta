<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class myhtmlminifier
{
	public function handle($request, Closure $next)
		{
			$response = $next($request);
			$contentType = $response->headers->get('Content-Type');
			if(strpos($contentType, needle: 'text/html') !==false) { 
				$response->setContent($this->minify2($response->getContent()));
			}
			return $response;
		}
	
	public function minify2($input)
		{
			$search = [
				'/\>\s+/s',
				'/\s+</s',
			];
			$replace = [
				'> ',
				' <',
			];
			return preg_replace($search, $replace, $input);
		}
}
