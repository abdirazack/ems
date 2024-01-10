<?php

namespace App\Filament\Resources\StateResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'cities';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('City Information')
                ->columns(1)
                ->Schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                ]),

            Section::make('Country & State')
                ->columns(2)
                ->Schema([
                    Select::make('country_id')
                        ->relationship('country', 'name')
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('country_code')
                        ->required()
                        ->maxLength(255),
                    Select::make('state_id')
                        ->relationship('state', 'name')
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('state_code')
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Locations')
                ->columns(2)
                ->Schema([
                    TextInput::make('latitude')
                        ->maxLength(255),
                    TextInput::make('longitude')
                        ->maxLength(255),
                ]),

            Section::make('Others')
                ->columns(2)
                ->Schema([
                    TextInput::make('wikiDataId')
                        ->maxLength(255),
                    Toggle::make('flag')
                        ->required(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                ->label('Country Name')
                ->numeric()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('state.name')
                ->label('State Name')
                ->searchable()
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('state_code')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable()
                ->label('State Code')
                ->searchable(),
            Tables\Columns\TextColumn::make('name')
                ->label('City Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('country_code')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable()
                ->searchable()
                ->searchable(),
            Tables\Columns\TextColumn::make('latitude')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            Tables\Columns\TextColumn::make('longitude')
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
            Tables\Columns\IconColumn::make('flag')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            Tables\Columns\TextColumn::make('wikiDataId')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            Tables\Columns\TextColumn::make('deleted_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
