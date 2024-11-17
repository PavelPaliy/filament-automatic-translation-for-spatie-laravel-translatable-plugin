<?php

namespace Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Livewire;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\ViewField;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ModalForTranslation extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $mainData = [];

    public array $locales;
    public bool $isFieldsAreTranslating = false;
    public Model $record;
    public function render()
    {
        return view('automatic-translation::livewire.modal-for-translation');
    }

    public function mount(): void
    {
        $this->mainForm->fill();
    }

    public function translate(): void
    {
        $this->validate([
            'mainData.translate_from' => 'required',
            'mainData.translate_to' => 'required',
        ]);
        $translatable = $this->record->translatable;
        $recordArray = $this->record->toArray();
        $dataForTranslate = [];
        foreach ($translatable as $field) {
            if(isset($recordArray[$field][$this->mainData['translate_from']])){
                $dataForTranslate[$field] = $recordArray[$field][$this->mainData['translate_from']];
            }

        }
        $this->isFieldsAreTranslating = true;
        $this->dispatch('request_for_translation',
            dataForTranslate: $dataForTranslate,
            translate_from:$this->mainData['translate_from'],
            translate_to:$this->mainData['translate_to']
        );
    }

    protected function getForms(): array
    {
        return [
            'mainForm'
        ];
    }

    public function mainForm(Form $form): Form
    {
        $options = [];
        $this->locales = count($this->locales) === 0 ? filament('spatie-laravel-translatable')->getDefaultLocales() : $this->locales;
        foreach ($this->locales as $locale) {
            $options[$locale] = filament('spatie-laravel-translatable')->getLocaleLabel($locale);
        }
        return $form
            ->schema([
                Select::make('translate_from')
                    ->label(__('automatic-translation::forms.fields.translate_from'))
                    ->required()
                    ->options($options),
                Select::make('translate_to')
                    ->label(__('automatic-translation::forms.fields.translate_to'))
                    ->required()
                    ->options($options),
            ])
            ->statePath('mainData');
    }
}
