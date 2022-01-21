<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\Component;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\Toggle::make('visible')
                    ->required()
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\BelongsToSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('instructor_id')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        '1' => 'Live Course',
                        '2' => 'Recorded Course',
                    ])
                    ->required(),
                Forms\Components\Select::make('difficulty')
                    ->options([
                        '1' => 'Elementary School',
                        '2' => 'Middle School',
                        '3' => 'High School',
                        '4' => 'Adult Courses',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('short_summary')
                    ->maxLength(256)->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\RichEditor::make('summary')
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\RichEditor::make('prerequisite')
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\RichEditor::make('instructor_access_link')
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Forms\Components\TextInput::make('seats')
                    ->required(),
                Forms\Components\TextInput::make('price')->mask(
                    fn (Forms\Components\TextInput\Mask $mask) => $mask
                    ->patternBlocks([
                        'money' => fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->thousandsSeparator(',')
                            ->decimalSeparator('.'),
                    ])
                    ->pattern('$money')),
                Forms\Components\DateTimePicker::make('start_time'),
                Forms\Components\DateTimePicker::make('end_time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BooleanColumn::make('visible'),
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\TextColumn::make('instructor_id'),
                Tables\Columns\TextColumn::make('type')->enum([
                    '1' => 'Live',
                    '2' => 'Recorded',
                ]),
                Tables\Columns\TextColumn::make('difficulty')->enum([
                    '1' => 'Elementary',
                    '2' => 'Middle',
                    '3' => 'High',
                    '4' => 'Adult',
                ]),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SectionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
