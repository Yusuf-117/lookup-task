<?php

namespace App\Contracts;

interface UserDetailsInterface {
    /**
    * getUserDetails() - Make a request to get user details based on user props
    *
    * @param string $type - 'username' or 'id'
    * @param string $value - the value or username or id
    *
    * @return array The user details
    */

    public function getUserDetails( $type, $value );
}
