<?php

namespace RoleProvider;

use RoleProvider\Base;

/**
 * @SWG\Definition(definition="Author", type="object", required={"name"})
 */
class Permission extends Base
{
    private $configs;
    private $serviceName = 'permission';

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
                'list'   => 'permissions',
                'detail' => 'permissions/[id]',
                'create' => 'permissions',
                'update' => 'permissions/[id]',
                'delete' => 'permissions/[id]',
            ];
        }

        parent::__construct();
    }

    public function getPermissionList($params)
    {
        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->get($this->configs['list'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function getPermissionDetail($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['detail']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->get($this->configs['detail'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function createPermission($params)
    {
        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->post($this->configs['create'], $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function updatePermission($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['update']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->put($uri, $params, true);

        return $this->manageResponse($this->curl, $this->serviceName);
    }

    public function deletePermission($params)
    {
        //complete uri
        $uri = str_replace('[id]', $params['id'], $this->configs['delete']);

        //set curl
        $this->setCurl($this->configs['url']);

        $this->curl->delete($uri, $params);

        return $this->manageResponse($this->curl, $this->serviceName);
    }
}
