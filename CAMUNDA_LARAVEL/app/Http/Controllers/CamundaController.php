<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Camunda\Http\DeploymentClient;

class CamundaController extends Controller
{
    public function deployBpmn()
    {
        // Deploy bpmn file(s)
        DeploymentClient::create('test-deploy', '../CAMUNDA/diagram_1.bpmn');
    }

    public function getDeploymentList()
    {
        // Get deployment list
        $deployments = DeploymentClient::get();
        return $deployments;
    }


}
