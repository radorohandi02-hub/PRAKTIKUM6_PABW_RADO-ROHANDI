<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_beranda_mengarah_ke_form_lapor(): void
    {
        $this->get('/')->assertRedirect('/lapor');
    }
}
