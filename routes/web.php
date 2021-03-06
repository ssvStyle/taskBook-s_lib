<?php
/**
 * This is a routes file.
 *
 * The route and controller@method can be set in the format
 * route => controller@method
 * '/home' => 'home@index',
 *
 * route
 * '/article/show/{id}'
 *
 * {id} params
 *
 * or route
 * '/articles/page/{page}/sort/{sort}'
 *
 * {page} .. {sort} params
 *
 *
 * params will be added
 * and available in the controller
 * automatically in the variable $this->data[page]|$this->data[sort]...
 *
 */

return [
    '/' => 'home@index',
    '/home' => 'home@index',
    '/page/{pageNum}/field/{field}/sort/{sort}' => 'home@index',
    '/task/add' => 'Task@add',
    '/task/edit/{id}' => 'Task@edit',
    '/register' => 'authorization@register',
    '/login' => 'authorization@login',
    '/logout' => 'authorization@unsetSession',
];



