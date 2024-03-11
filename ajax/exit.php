<?php
    setcookie('login',$login,time()-3600*24*30,'/GitProjects/project1');
    setcookie('email',$email,time()-3600*24*30,'/GitProjects/project1');
    unset($_COOKIE[$login]);
    unset($_COOKIE[$email]);