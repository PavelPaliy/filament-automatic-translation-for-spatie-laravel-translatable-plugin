<?php

namespace Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Filament\Resources\Pages\EditRecord\Concerns;

trait AutomaticTranslatable
{
    public array $translatedFields = [];
    public string $translateToLanguage = '';
    public function updateTranslatedFields()
    {
        $this->setActiveLocale($this->translateToLanguage);
        foreach ($this->translatedFields as $key => $value) {
            $this->data[$key] = $value;
        }
        $this->dispatch("recordTranslated");
    }

}
