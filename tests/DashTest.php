<?php

namespace Tests;

use Dash;
use Tests\Toys\Route;

/**
 * mpetrovich/dash
 */
class DashTest extends BaseTestCase
{
    public function multiply_by_two(array $input)
    {
        return Dash\chain($input) // no method suggestions in PHPStorm!
            ->map(function (int $i) {
                return $i * 2;
            })
            ->value();
    }

    public function routes_to_unique_cities(array $input)
    {
        return Dash\chain($input)
            ->map(function (Route $route) {
                return [$route->getFrom(), $route->getTo()];
            })
            ->thru(function (array $twoDimensional) {
                return array_merge(...$twoDimensional); // no built-in flatMap!
            })
            ->thru(function (array $cities) {
                return array_unique($cities);
            })
            ->values()
            ->value();
    }
}