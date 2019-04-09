<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SqlInjectionTest extends TestCase
{
    /** @test */
    public function it_can_inject_sql()
    {
        DB::enableQueryLog();

        $this
            ->get('exploit-query-builder?sort=email->"%27))%23injectedSQL')
            ->assertOk();

        $executedQuery = collect(DB::getQueryLog())->first()['query'];

        $this->assertContains('#injectedSQL', $executedQuery);
    }
}
