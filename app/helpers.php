<?php

function gravatar_url($email)
{
    $email = md5($email);
    return "https://gravatar.com/avatar/{$email}?" . http_build_query([
        's' => 60,
        'd' => 'https://orbitermag.com/wp-content/uploads/2017/03/default-user-image.png'
    ]);
}