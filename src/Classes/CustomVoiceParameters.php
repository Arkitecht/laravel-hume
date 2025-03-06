<?php

namespace Arkitecht\LaravelHume\Classes;

class CustomVoiceParameters extends AbstractClass
{
    protected ?float $gender;
    protected ?float $assertiveness;
    protected ?float $buoyancy;
    protected ?float $confidence;
    protected ?float $enthusiasm;
    protected ?float $nasality;
    protected ?float $relaxedness;
    protected ?float $smoothness;
    protected ?float $tepidity;
    protected ?float $tightness;
    protected ?float $articulation;

    protected ?float $masculineFeminine;

    public function getGender(): ?float
    {
        return $this->gender;
    }

    public function setGender(?float $gender): CustomVoiceParameters
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAssertiveness(): ?float
    {
        return $this->assertiveness;
    }

    public function setAssertiveness(?float $assertiveness): CustomVoiceParameters
    {
        $this->assertiveness = $assertiveness;

        return $this;
    }

    public function getBuoyancy(): ?float
    {
        return $this->buoyancy;
    }

    public function setBuoyancy(?float $buoyancy): CustomVoiceParameters
    {
        $this->buoyancy = $buoyancy;

        return $this;
    }

    public function getConfidence(): ?float
    {
        return $this->confidence;
    }

    public function setConfidence(?float $confidence): CustomVoiceParameters
    {
        $this->confidence = $confidence;

        return $this;
    }

    public function getEnthusiasm(): ?float
    {
        return $this->enthusiasm;
    }

    public function setEnthusiasm(?float $enthusiasm): CustomVoiceParameters
    {
        $this->enthusiasm = $enthusiasm;

        return $this;
    }

    public function getNasality(): ?float
    {
        return $this->nasality;
    }

    public function setNasality(?float $nasality): CustomVoiceParameters
    {
        $this->nasality = $nasality;

        return $this;
    }

    public function getRelaxedness(): ?float
    {
        return $this->relaxedness;
    }

    public function setRelaxedness(?float $relaxedness): CustomVoiceParameters
    {
        $this->relaxedness = $relaxedness;

        return $this;
    }

    public function getSmoothness(): ?float
    {
        return $this->smoothness;
    }

    public function setSmoothness(?float $smoothness): CustomVoiceParameters
    {
        $this->smoothness = $smoothness;

        return $this;
    }

    public function getTepidity(): ?float
    {
        return $this->tepidity;
    }

    public function setTepidity(?float $tepidity): CustomVoiceParameters
    {
        $this->tepidity = $tepidity;

        return $this;
    }

    public function getTightness(): ?float
    {
        return $this->tightness;
    }

    public function setTightness(?float $tightness): CustomVoiceParameters
    {
        $this->tightness = $tightness;

        return $this;
    }

    public function getArticulation(): ?float
    {
        return $this->articulation;
    }

    public function setArticulation(?float $articulation): CustomVoiceParameters
    {
        $this->articulation = $articulation;

        return $this;
    }

    public function getMasculineFeminine(): ?float
    {
        return $this->masculineFeminine;
    }

    public function setMasculineFeminine(?float $masculineFeminine): CustomVoiceParameters
    {
        $this->masculineFeminine = $masculineFeminine;

        return $this;
    }
}
