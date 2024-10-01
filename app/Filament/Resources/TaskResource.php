<?php

namespace App\Filament\Resources;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\Task;
use App\Models\TeamMember;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('project_id')
                            ->label('Select Project')
                            ->options(Project::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Select::make('milestone_id')
                            ->label('Select Milestone')
                            ->options(Milestone::all()->pluck('name', 'id'))
                            ->searchable(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        ToggleButtons::make('status')
                            ->options(TaskStatus::class)
                            ->default(TaskStatus::Pending)
                            ->inline()
                            ->required(),
                        DatePicker::make('due_date')
                            ->required(),
                        Select::make('assigned_to')
                            ->relationship('assignedTo', 'name')
                            ->createOptionForm(TeamMemberResource::formSchema())
                            ->createOptionModalHeading('Create Team Member')
                            ->options(TeamMember::all()->pluck('name', 'id'))
                            ->searchable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name'),
                TextColumn::make('milestone.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('assignedTo.name'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
