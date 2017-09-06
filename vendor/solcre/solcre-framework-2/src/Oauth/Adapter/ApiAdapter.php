<?php

namespace Solcre\SolcreFramework2\Oauth\Adapter;

use ZF\OAuth2\Adapter\PdoAdapter;

class ApiAdapter extends PdoAdapter
{

    const USER_TABLE = 'usuarios';

    public function getUser($username)
    {
        $stmt = $this->db->prepare($sql = sprintf('SELECT * from %s where usuario=:usuario', self::USER_TABLE));
        $stmt->execute(array('usuario' => $username));


        if (!$userInfo = $stmt->fetch()) {
            return false;
        }

        // the default behavior is to use "username" as the user_id
        $result = array_merge(array(
            'user_id' => $username
        ), $userInfo);

        return $result;
    }

    /**
     * Check password using bcrypt
     *
     * @param string $user
     * @param string $password
     *
     * @return bool
     */
    protected function checkPassword($user, $password)
    {
        return $this->verifyHash($password, $user['clave']);
    }

    /**
     * Set the user
     *
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     *
     * @return bool
     */
    public function setUser($username, $password, $firstName = null, $lastName = null)
    {
        // do not store in plaintext, use bcrypt
        $this->createBcryptHash($password);

        // if it exists, update it.
        if ($this->getUser($username)) {
            $stmt = $this->db->prepare(sprintf(
                'UPDATE %s SET clave=:clave where usuario=:usuario', self::USER_TABLE
            ));
        } else {
            $stmt = $this->db->prepare(sprintf(
                'INSERT INTO %s (usuario, clave) VALUES (:usuario, :clave)', self::USER_TABLE
            ));
        }

        return $stmt->execute(compact('usuario', 'clave'));
    }

    public function setAccessToken($access_token, $client_id, $user_id, $expires, $scope = null)
    {
        // convert expires to datestring
        $expires = date('Y-m-d H:i:s', $expires);

        // if it exists, update it.
        if ($this->getAccessToken($access_token)) {
            $stmt
                = $this->db->prepare(sprintf('UPDATE %s SET client_id=:client_id, expires=:expires, user_id=:user_id, scope=:scope where access_token=:access_token',
                $this->config['access_token_table']));
        } else {
            $stmt
                = $this->db->prepare(sprintf('INSERT INTO %s (access_token, client_id, expires, user_id, scope) VALUES (:access_token, :client_id, :expires, :user_id, :scope)',
                $this->config['access_token_table']));
        }
        $this->saveLoginData($user_id);
        $this->saveLoginLog($user_id, $client_id);
        return $stmt->execute(compact('access_token', 'client_id', 'user_id', 'expires', 'scope'));
    }

    private function getClientIp()
    {
        $ipaddress = '';
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            if (getenv('HTTP_X_FORWARDED')) {
                $ipaddress = getenv('HTTP_X_FORWARDED');
            } else {
                if (getenv('HTTP_FORWARDED_FOR')) {
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                } else {
                    if (getenv('HTTP_FORWARDED')) {
                        $ipaddress = getenv('HTTP_FORWARDED');
                    } else {
                        if (getenv('REMOTE_ADDR')) {
                            $ipaddress = getenv('REMOTE_ADDR');
                        }
                    }
                }
            }
        }
        return $ipaddress;
    }

    private function saveLoginData($userId)
    {
        $now = date('Y-m-d H:i:s');
        $clientIp = $this->getClientIp();
        $sql = sprintf('UPDATE %s SET last_login="' . $now . '", last_ip="' . $clientIp . '" where usuario="' . $userId . '"',
            self::USER_TABLE);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    private function saveLoginLog($userId, $clientId)
    {
        $now = date('Y-m-d H:i:s');
        $clientIp = $this->getClientIp();
        $user = $this->getUser($userId);
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        if (!empty($user)) {
            $sql = 'INSERT INTO `users_logs'
                . '`(`date`, `ip`, `user_id`, `user_agent`, `client_id`) VALUES '
                . '("' . $now . '", "' . $clientIp . '", ' . $user['id'] . ', "' . $userAgent . '", "' . $clientId . '")';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }
    }
}

?>