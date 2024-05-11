<?php
    $salt = "7lt/KydQRVcSU*GyxqelC3QiY#8M!HtoR2JWSHvNt5.oXy:?IA#P5ylTYa)TswcJkE=cR9mKs@V1Txvan:AwG)yM?ka*8tUeEUKWh18H:Y5F*--EbK=2g0EY/RGxkXfS1ny19gqyG#27J*3iEQ4N4rBeLq0r)AXB3=S8N+fh-CAdijHi0o:q=6Ph8EUuDttj_4dgpOck";
    $password = "mypassword";
    $hashed_password = md5($salt.$password);

    echo($hashed_password);

    // ad234a9b32fbb7782e427e212be18525-ed54d65c-6ad02178

    
?>