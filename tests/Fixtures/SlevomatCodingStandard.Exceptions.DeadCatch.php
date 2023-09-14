<?php

try {
    echo 0;
} catch (Throwable) {
    echo 1;
} catch (RuntimeException) {
    echo 2;
}
