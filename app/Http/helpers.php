<?php

function sitinfo()
{
        $info = \App\Models\Setting::first();
        return $info;
}
