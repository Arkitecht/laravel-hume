<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Classes\CustomVoice;
use Arkitecht\LaravelHume\Classes\CustomVoiceParameters;
use Arkitecht\LaravelHume\Enums\BaseVoice;
use Arkitecht\LaravelHume\Exceptions\RequestException;
use Arkitecht\LaravelHume\Facades\Hume;

class CustomVoicesTest extends TestCase
{
    /** @test */
    function can_get_prompts()
    {
        $response = Hume::listCustomVoices();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getCustomVoicesPage());
    }

    /** @test */
    function can_create_custom_voice()
    {
        $voice = $this->customVoiceObject();
        $response = Hume::createCustomVoice($voice);

        $this->assertNotEmpty($response);
        $this->assertEquals(BaseVoice::FINN, $response->getBaseVoice());

        Hume::deleteCustomVoice($response->getId());
    }

    /** @test */
    function can_delete_custom_voice()
    {
        $voice = $this->customVoiceObject();
        $customVoice = Hume::createCustomVoice($voice);

        $response = Hume::deleteCustomVoice($customVoice->getId());
        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        try {
            $response = Hume::listCustomVoices(['name' => $voice->getName()]);
        } catch (RequestException $exception) {
            $this->assertStringContainsString('Custom Voice (NAME: ' . $voice->getName() . ') does not exist ', $exception->getMessage());
        }
    }

    /** @test */
    function can_get_custom_voice()
    {
        $voice = Hume::createCustomVoice($this->customVoiceObject());

        $response = Hume::getCustomVoice($voice->getId());

        $this->assertNotEmpty($response);
        $this->assertEquals(BaseVoice::FINN, $response->getBaseVoice());
        $this->assertEquals($voice->getId(), $response->getId());

        Hume::deleteCustomVoice($response->getId());
    }

    /** @test */
    function can_create_custom_voice_version()
    {
        $voice = $this->customVoiceObject();
        $initialVoice = Hume::createCustomVoice($voice);

        $this->assertNotEmpty($initialVoice);
        $this->assertEquals(BaseVoice::FINN, $initialVoice->getBaseVoice());

        $version = $this->customVoiceObject()
            ->setName("")
            ->setBaseVoice(BaseVoice::ITO);
        try {
            $response = Hume::createCustomVoiceVersion($initialVoice->getId(), $version);
        } catch (RequestException $exception) {
            dump($exception->getMessage());
            dd(Hume::getLastRequest(), Hume::getLastResponse());
        }

        $this->assertNotEmpty($response);
        $this->assertEquals($initialVoice->getId(), $response->getId());
        $this->assertEquals(1, $response->getVersion());
        $this->assertEquals(BaseVoice::ITO, $response->getBaseVoice());

        Hume::deleteCustomVoice($response->getId());
    }

    /** @test */
    function can_update_custom_voice_name()
    {
        $voice = $this->customVoiceObject();
        $initialVoice = Hume::createCustomVoice($voice);

        $this->assertNotEmpty($initialVoice);
        $this->assertEquals(strtoupper($voice->getName()), $initialVoice->getName());

        $name = $initialVoice->getName() . ' updated';
        $response = Hume::updateCustomVoiceName($initialVoice->getId(), $name);

        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        $updated = Hume::getCustomVoice($initialVoice->getId());
        $this->assertEquals(strtoupper($name), $updated->getName());

        Hume::deleteCustomVoice($initialVoice->getId());
    }


    private function customVoiceObject(?string $name = null, ?BaseVoice $baseVoice = null, CustomVoiceParameters $parameters = null): CustomVoice
    {
        if (!$name) {
            $name = 'Test Voice ' . time();
        }
        if (!$baseVoice) {
            $baseVoice = BaseVoice::from('FINN');
        }

        $customVoice = (new CustomVoice())
            ->setName($name)
            ->setBaseVoice($baseVoice);

        if ($parameters) {
            $customVoice->setParameters($parameters);
        }

        return $customVoice;
    }
}
