<?php

function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args() === 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}


function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}

function link_to($button, $action, $method)
{
    $csrf = csrf_field();
    return <<<EOT
    <form method="POST" action="{$action}">
        $csrf 
        <input type="hidden" name="_method" value="{$method}">
        <button type="submit" class="btn btn-sm">{$button}</button>
    </form>
EOT;
}
