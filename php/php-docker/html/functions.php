<?php

    function get_window_title($title) {
        return $title.' - My awesome title';
    }

    function user_has_role($role) {
        // customer or subscriber
        if ($role) {
            return $role;
        }
        return "Not valid role";
    }

    function is_signed_in() {

        //return true or false
    }


?>