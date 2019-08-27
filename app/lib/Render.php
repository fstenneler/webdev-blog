<?php

function esc($html)
{
    if(!preg_match("#<#",htmlspecialchars_decode($html))) {
        return htmlspecialchars($html);
    }
    return $html;
}
