<?php

function a(): void
{
    if (isset($a)) {
        echo $a;
    } else {
        return;
    }

    echo 0;
}
