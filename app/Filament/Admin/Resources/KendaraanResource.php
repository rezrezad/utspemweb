<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Models\Kendaraan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Data Kendaraan';

    protected static ?string $modelLabel = 'Kendaraan';

    protected static ?string $pluralModelLabel = 'Daftar Kendaraan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kendaraan')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kendaraan')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Kendaraan'),
                        Forms\Components\TextInput::make('nomor_plat')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->label('Nomor Plat'),
                        Forms\Components\TextInput::make('merk')
                            ->required()
                            ->maxLength(100)
                            ->label('Merk Kendaraan'),
                        Forms\Components\TextInput::make('model')
                            ->required()
                            ->maxLength(100)
                            ->label('Model Kendaraan'),
                        Forms\Components\TextInput::make('tahun_produksi')
                            ->required()
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y') + 1)
                            ->label('Tahun Produksi'),
                        Forms\Components\TextInput::make('warna')
                            ->required()
                            ->maxLength(50)
                            ->label('Warna'),
                        Forms\Components\Select::make('jenis')
                            ->options([
                                'Mobil' => 'Mobil',
                                'Motor' => 'Motor',
                                'Truk' => 'Truk',
                                'Bus' => 'Bus',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->label('Jenis Kendaraan'),
                    ]),
                Forms\Components\Section::make('Informasi Teknis')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_mesin')
                            ->maxLength(100)
                            ->label('Nomor Mesin'),
                        Forms\Components\TextInput::make('nomor_rangka')
                            ->maxLength(100)
                            ->label('Nomor Rangka'),
                        Forms\Components\Textarea::make('keterangan')
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->label('Keterangan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kendaraan')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kendaraan'),
                Tables\Columns\TextColumn::make('nomor_plat')
                    ->searchable()
                    ->sortable()
                    ->label('Nomor Plat'),
                Tables\Columns\TextColumn::make('merk')
                    ->searchable()
                    ->sortable()
                    ->label('Merk'),
                Tables\Columns\TextColumn::make('model')
                    ->searchable()
                    ->sortable()
                    ->label('Model'),
                Tables\Columns\TextColumn::make('tahun_produksi')
                    ->numeric()
                    ->sortable()
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('warna')
                    ->searchable()
                    ->label('Warna'),
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mobil' => 'success',
                        'Motor' => 'info',
                        'Truk' => 'warning',
                        'Bus' => 'danger',
                        default => 'gray',
                    })
                    ->label('Jenis'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Tanggal Dibuat'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Terakhir Diupdate'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->options([
                        'Mobil' => 'Mobil',
                        'Motor' => 'Motor',
                        'Truk' => 'Truk',
                        'Bus' => 'Bus',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->label('Jenis Kendaraan'),
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
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}