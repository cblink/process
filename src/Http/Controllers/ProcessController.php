<?php


namespace Cblink\Process\Http\Controllers;


use Cblink\Process\Http\Middleware\Authenticate;
use Cblink\Process\Process;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProcessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function index(Request $request)
    {
        $name = $request->get('name');

        $process =  new Process($name);

        return $process->getProcess();
    }
}