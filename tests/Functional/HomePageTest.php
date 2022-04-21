<?php

declare(strict_types=1);

namespace Tests\Functional;


class HomePageTest extends KernelTestCase
{

    /**
     * @test
     */
    /*public function itLoadsHomePage(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->assertSeeElement('#header')
            ->assertSeeElement('#main')
            ->assertSeeElement('#footer')
            ->assertSeeElement('section.wrapper');
    }*/

    /**
     * @dataProvider homePageLinks
     *
     * @test
     */
    /*public function itLoadsHomePageLinks(string $link): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->click($link)
            ->assertSuccessful();
    }*/

   /* public function homePageLinks(): iterable
    {
        return [
            ['Basic Entities'],
            ['Forms'],
            ['Forms Ajax'],
            ['Cookie Policy'],
            ['Privacy policy'],
        ];
    }*/
}
