<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ShortPathService;
use Mockery;
use Cache;

class ShortPathServiceTest extends TestCase
{
    public function test_find_or_create_short_url(): void
    {
        $originalUrl = 'https://www.example.com';
        $expectedShortPath = 'abc123';
        $expectedShortUrl = url($expectedShortPath);

        $shortPathMock = Mockery::mock('alias:App\Models\ShortPath');
        $shortPathMock->shouldReceive('where')->once()->with('original_url', $originalUrl)->andReturnSelf();
        $shortPathMock->shouldReceive('first')->once()->andReturn((object)['short_path' => $expectedShortPath]);

        $shortPathService = new ShortPathService();

        $shortUrl = $shortPathService->findOrCreateShortUrl($originalUrl);



        $this->assertStringContainsString($shortUrl, $expectedShortUrl);
    }

    public function test_find_original_url()
    {
        $shortPath = 'abc123';
        $expectedOriginalUrl = 'https://www.example.com';
        $mockedRecord = (object) ['original_url' => $expectedOriginalUrl];

        Cache::shouldReceive('remember')
            ->once()
            ->with($shortPath, 300, \Mockery::any())
            ->andReturn($mockedRecord);

        $shortPathService = new ShortPathService();

        $originalUrl = $shortPathService->findOriginalUrl($shortPath);

        $this->assertEquals($originalUrl, $expectedOriginalUrl);
    }

}
