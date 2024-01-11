<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CountryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Filament\Resources\CountryResource\RelationManagers\StatesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationLabel = 'Country';
    protected static ?string $modelLabel = 'Country';
    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Country Info')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('name')
                            ->label('Country Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('capital')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Currency')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('currency')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('currency_symbol')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Country Codes')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('phonecode')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('iso3')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('iso2')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('wikiDataId')
                            ->maxLength(65535),
                        TextInput::make('tld')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('flag')
                            ->required(),
                    ]),
                Section::make('Region and Locations')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('region')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('subregion')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('latitude')
                            ->required()
                            ->maxLength(65535),
                        TextInput::make('longitude')
                            ->required()
                            ->maxLength(65535)

                    ]),

                Section::make('Emojis')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('emoji')
                            ->required()
                            ->maxLength(65535),
                        TextInput::make('emojiU')
                            ->required()
                            ->maxLength(65535),

                    ]),

                Section::make('Others')
                    ->columns(2)
                    ->Schema([
                        TextInput::make('timezones')
                            ->json()
                            ->required()
                            ->maxLength(65535),
                        TextInput::make('translations')
                            ->json()
                            ->maxLength(65535),
                        TextInput::make('native')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),







            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('emoji')
                    ->label('Flag')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Country Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->label('Region')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subregion')
                    ->label('Sub Region')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso2')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->label('Phone Code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Capital')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->label('Currency')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tld')
                    ->label('Top Level Domain')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('native')
                    ->sortable()
                    ->label('Natives')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StatesRelationManager::class,
            EmployeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'view' => Pages\ViewCountry::route('/{record}'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
