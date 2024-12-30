<?php

namespace App\Filament\Resources;
use Illuminate\Http\UploadedFile;
use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('room_number')->required(),
                Forms\Components\Select::make('type')->options([
                    'single' => 'Single',
                    'double' => 'Double',
                    'suite' => 'Suite',
                ])->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Select::make('status')->options([
                    'available' => 'Available',
                    'booked' => 'Booked',
                ])->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->maxSize(2048)
                    ->getUploadedFileNameForStorageUsing(function (UploadedFile $file) {
                        $filename = $file->getClientOriginalName();
                        return 'images/' . $filename;
                    })
                    ->preserveFilenames()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('room_number')
                    ->label('Room Number')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Room Type')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->sortable(),
                    ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        return asset('storage/' . $record->image);
                    })
                    ->sortable(),
            ])
            ->filters([
              
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }    
}
