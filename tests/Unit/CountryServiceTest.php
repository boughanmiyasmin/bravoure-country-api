<?php

namespace Tests\Unit;

use App\Cache\CountryCache;
use App\Services\CountryService;
use App\Cache\YoutubeCache;
use App\Cache\WikiCache;
use App\Repositories\CountryRepository;
use App\Services\WikipediaService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetYoutubeDataReturnsCachedResponse()
    {
        // Create mock dependencies
        $youtubeCache = $this->createMock(YoutubeCache::class);
        $youtubeCache->expects($this->once())
            ->method('getCache')
            ->with('country_id')
            ->willReturn(['cached' => 'response']);

        // Create the service instance with mock dependencies
        $countryService = new CountryService(
            $this->app->make(CountryRepository::class),
            $youtubeCache,
            $this->createMock(WikiCache::class),
            $this->createMock(CountryCache::class),
            $this->createMock(WikipediaService::class)
        );

        // Call the method being tested
        $response = $countryService->getYoutubeData('country_id');

        // Assert the response
        $this->assertEquals(['cached' => 'response'], $response);
    }

    public function testGetWikiDataReturnsCachedResponse()
    {
        // Create mock dependencies
        $wikiCache = $this->createMock(WikiCache::class);
        $wikiCache->expects($this->once())
            ->method('getCache')
            ->with('country_id')
            ->willReturn('cached wiki response');

        // Create the service instance with mock dependencies
        $countryService = new CountryService(
            $this->app->make(CountryRepository::class),
            $this->createMock(YoutubeCache::class),
            $wikiCache,
            $this->createMock(CountryCache::class),
            $this->createMock(WikipediaService::class)
        );

        // Call the method being tested
        $response = $countryService->getWikiData('country_id');

        // Assert the response
        $this->assertEquals('cached wiki response', $response);
    }

    public function testGetCountriesReturnsCachedData()
    {
        // Create mock dependencies
        $countryCache = $this->createMock(CountryCache::class);
        $countryCache->expects($this->once())
            ->method('getCache')
            ->willReturn(Carbon::now()->subMinutes(5)); // Cache within the last 10 minutes

        // Create a mock instance of CountryRepository
        $mockedRepository = $this->createMock(CountryRepository::class);
        $mockedRepository->expects($this->once())
            ->method('findCountries')
            ->with([], 10, 1)
            ->willReturn(['cached' => 'data']);

        // Create the service instance with mock dependencies
        $countryService = new CountryService(
            $mockedRepository,
            $this->createMock(YoutubeCache::class),
            $this->createMock(WikiCache::class),
            $countryCache,
            $this->createMock(WikipediaService::class)
        );

        // Call the method being tested
        $response = $countryService->getCountries([], 10, 1);

        // Assert the response
        $this->assertEquals(['cached' => 'data'], $response);
    }
}
