<?php

return [
    // Twitter bootstrap 4.x template
    'bootstrap4'                   => array(
        'wrapper'                 => "<nav aria-label=\"Page navigation\"><ul class=\"pagination\">\n\t{pagination}\n\t</ul></nav>\n",

        'first'                   => "\n\t\t<li class=\"page-item\">{link}</li>",
        'first-marker'            => "&laquo;&laquo;",
        'first-link'              => "<a class=\"page-link\" href=\"{uri}\">{page}</a>",

        'first-inactive'          => "",
        'first-inactive-link'     => "",

        'previous'                => "\n\t\t<li class=\"page-item\">{link}</li>",
        'previous-marker'         => "&laquo;",
        'previous-link'           => "<a class=\"page-link\" href=\"{uri}\" rel=\"prev\">{page}</a>",

        'previous-inactive'       => "\n\t\t<li class=\"page-item disabled\">{link}</li>",
        'previous-inactive-link'  => "<a class=\"page-link\" href=\"#\" rel=\"prev\">{page}</a>",

        'regular'                 => "\n\t\t<li class=\"page-item\">{link}</li>",
        'regular-link'            => "<a class=\"page-link\" href=\"{uri}\">{page}</a>",

        'active'                  => "\n\t\t<li class=\"page-item active\">{link}</li>",
        'active-link'             => "<a class=\"page-link\" href=\"#\">{page} <span class=\"sr-only\"></span></a>",

        'next'                    => "\n\t\t<li class=\"page-item\">{link}</li>",
        'next-marker'             => "&raquo;",
        'next-link'               => "<a class=\"page-link\" href=\"{uri}\" rel=\"next\">{page}</a>",

        'next-inactive'           => "\n\t\t<li class=\"page-item disabled\">{link}</li>",
        'next-inactive-link'      => "<a class=\"page-link\" href=\"#\" rel=\"next\">{page}</a>",

        'last'                    => "\n\t\t<li class=\"page-item\">{link}</li>",
        'last-marker'             => "&raquo;&raquo;",
        'last-link'               => "<a class=\"page-link\" href=\"{uri}\">{page}</a>",

        'last-inactive'           => "",
        'last-inactive-link'      => "",
    ),
];
