<?php

function a(): void
{
    if (isset($a)) {
        echo 0;
        return;
    }

    echo 1;
}
