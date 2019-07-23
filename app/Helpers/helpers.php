<?php


if (!function_exists('generate_link_badge')) {
    function generate_link_badge($title, $link = "#", $color = "primary")
    {
        return "<a href='$link' class='badge badge-$color'>$title</a>";
    }
}