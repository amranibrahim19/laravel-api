<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->options(
                        \App\Models\User::query()
                            ->orderBy('name')
                            ->get()
                            ->mapWithKeys(fn ($user) => [$user->id => $user->name])
                    )
                    ->required()
                    ->autofocus()
                    ->placeholder('Select a user'),

                Forms\Components\TextInput::make('title')

                    ->autofocus()
                    ->required()
                    ->placeholder('Enter a title'),

                Forms\Components\Textarea::make('content')
                    ->autofocus()
                    ->placeholder('Enter a description'),

                Forms\Components\Radio::make('status')
                    ->options([
                        false => 'Incomplete',
                        true => 'Complete',
                    ])
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => route('tasks.edit', $record))
                    ->formatStateUsing(function ($state) {
                        $truncate = Str::limit($state, 50);
                        return $truncate;
                    }),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('status')
                    ->afterStateUpdated(function ($record, $state) {
                        $record->update(['status' => $state]);

                        Notification::make()
                            ->title('Saved successfully')
                            ->success()
                            ->send();
                    })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
