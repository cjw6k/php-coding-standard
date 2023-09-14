<?php

function a(): void
{
    if (isset($a)) {
        if (isset($aa)) {
            if (isset($aaa)) {
                if (isset($aaaa)) {
                    if (isset($aaaaa)) {
                        echo 0;
                    } elseif (isset($bbbbb)) {
                        echo 0;
                    } else {
                        echo 0;
                    }
                } elseif (isset($bbbb)) {
                    echo 0;
                } else {
                    echo 0;
                }
            } elseif (isset($bbb)) {
                echo 0;
            } else {
                echo 0;
            }
        } elseif (isset($bb)) {
            echo 0;
        } else {
            echo 0;
        }
    } elseif (isset($b)) {
        echo 0;
    } else {
        echo 0;
    }
}
