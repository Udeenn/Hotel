<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')->required(),
                Forms\Components\Select::make('room_id')
                    ->label('Room')
                    ->relationship('room', 'room_number')
                    ->required(),
                Forms\Components\DatePicker::make('check_in_date')->required(),
                Forms\Components\DatePicker::make('check_out_date')->required(),
                Forms\Components\TextInput::make('total_price')
                ->numeric()
                ->required()
                ->reactive()  // Memicu pembaruan jika state lainnya diperbarui
                ->afterStateUpdated(function ($state, callable $set, $get) {
                    // Ambil harga kamar dari room_id yang dipilih
                    $room = \App\Models\Room::find($get('room_id'));

                    // Periksa jika room ditemukan dan tanggal check-in serta check-out valid
                    if ($room && $get('check_in_date') && $get('check_out_date')) {
                        $checkInDate = Carbon::parse($get('check_in_date'));
                        $checkOutDate = Carbon::parse($get('check_out_date'));

                        // Hitung lama menginap dalam hari
                        $days = $checkInDate->diffInDays($checkOutDate);

                        // Set total price berdasarkan harga kamar dan jumlah hari
                        $set('total_price', $room->price * $days);
                    }
                }),
            ]);
    }

public static function table(Table $table): Table{
    return $table
        ->columns([
            TextColumn::make('customer_name')
                ->label('Customer Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('room.room_number')
                ->label('Room Number')
                ->sortable()
                ->searchable(),

            TextColumn::make('room.type')
                ->label('Room Type')
                ->sortable(),

            TextColumn::make('total_price')
                ->label('Total Price')
                ->sortable()
                ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),

            TextColumn::make('room.status')
                ->label('Room Status')
                ->sortable(),

            TextColumn::make('room.description')
                ->label('Room Description')
                ->sortable(),

            TextColumn::make('check_in_date')
                ->label('Check In Date')
                ->sortable(),

            TextColumn::make('check_out_date')
                ->label('Check Out Date')
                ->sortable(),
        ])
        ->filters([
            // Filter bisa ditambahkan di sini jika diperlukan
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }    
}
