<?php
namespace IMSGlobal\LTI13;

interface Cookie {
    public function get_cookie($name);
    public function set_cookie($name, $value, $exp = 3600, $options = []);
}
?>
