# filament-automatic-translation-for-spatie-laravel-translatable-plugin
This add-on to [Spatie Translatable](https://filamentphp.com/plugins/filament-spatie-translatable) allows you to translate multilingual fields automatically. It supports texts with lengths of more than 5000 symbols.

## Requirements

You need the latest version of Filament v3. Also, you need to install [Spatie Translatable](https://filamentphp.com/plugins/filament-spatie-translatable) plugin.

## Installation

Install the plugin with Composer:

```bash
composer require pavelpaliy/filament-filament-automatic-translation-for-spatie-laravel-translatable-plugin
```
## Add plugin to EditRecord

On the page where you need to add a translation and edit the record, you should apply the `AutomaticTranslatable` trait to it, and install a `TranslateAction` header action:
```php
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Actions\TranslateAction;
use Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Filament\Resources\Pages\EditRecord\Concerns\AutomaticTranslatable;

class EditBlogPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use AutomaticTranslatable;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            TranslateAction::make()
            // ...
        ];
    }
    
    // ...
}
```
## Publishing translations

If you wish to translate the package, you may publish the language files using:

```bash
php artisan vendor:publish --tag=filament-filament-automatic-translation-for-spatie-laravel-translatable-plugin
```
