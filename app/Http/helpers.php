<?php

function sitinfo()
{
        $info = \App\Models\setting::first();
        return $info;
}
