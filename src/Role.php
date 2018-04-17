<?php

namespace RoleProvider;

use RoleProvider\Base;

/**
 * @SWG\Definition(definition="Author", type="object", required={"name"})
 */
class Role extends Base
{
    private $configs;
    private $serviceName = 'role';

    // $config = [
    //     'url'    => 'http://ms-user-api.develop:8001/',
    //     'login'  => 'users/login',
    //     'create' => 'users',
    // ];

    public function __construct($configs = null)
    {

        if (!empty($configs)) {
            $this->configs = $configs;
        } else {
            $this->configs = [
                'url'    => 'http://ms-role-api.develop/',
                'list'   => 'roles',
                'detail' => 'roles/[id]',
                'create' => 'roles',
                'update' => 'roles/[id]',
                'delete' => 'roles/[id]',
            ];
        }

        parent::__construct();
    }

    public function getRoleList($params)
    {
        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->get($this->configs['list'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function getRoleDetail($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['detail']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->get($uri, $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function createRole($params)
    {
        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->post($this->configs['create'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function updateRole($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['update']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->put($uri, $params, true);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function deleteRole($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['delete']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->delete($uri, $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }
}
