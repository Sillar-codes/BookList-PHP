<?php

namespace EShopPhp\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::render("index", [
            "title" => "Booklist PHP"
        ]);

        $this->expectOutputRegex("[html]");
        $this->expectOutputRegex("[body]");
        $this->expectOutputRegex("[Booklist PHP]");
    }
}