<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('logged_in')) {
            return redirect()->to('/login')->with('message', 'Silahkan login dahulu !');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {}
}
