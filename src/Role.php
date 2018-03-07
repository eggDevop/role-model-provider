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

        //set curl
        $this->setCurl($this->configs['url']);

    }

    public function getRoleList($params)
    {
        $this->curl->get($this->configs['list'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function getRoleDetail($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['detail']);

        $this->curl->get($this->configs['detail'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function createRole($params)
    {
        $this->curl->post($this->configs['create'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function updateRole($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['update']);

        $this->curl->put($uri, $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function deleteRole($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['delete']);

        $this->curl->delete($uri, $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }
}
