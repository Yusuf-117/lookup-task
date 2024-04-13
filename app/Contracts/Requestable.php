<?php

namespace App\Contracts;

interface Requestable{
    /**
     * Make a request based on user props
     *
     * @return array The user details
     */
    public function makeRequest();
}
