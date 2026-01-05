<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentProfileResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Src\Application\UseCases\ApproveStudentUseCase;

class StudentProfileResource extends Resource
{
    protected static ?string $model = \Src\Infrastructure\Models\StudentProfileModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Étudiants';
    protected static ?string $navigationGroup = 'Gestion académique';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nom')->disabled(),
            TextInput::make('prenom')->disabled(),
            TextInput::make('filiere')->disabled(),
            TextInput::make('status')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')->label('User ID'),
                TextColumn::make('nom')->label('Nom'),
                TextColumn::make('prenom')->label('Prénom'),
                TextColumn::make('filiere')->label('Filière'),
                BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'PENDING',
                        'success' => 'APPROVED',
                        'danger' => 'REJECTED',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'PENDING' => 'En attente',
                        'APPROVED' => 'Validé',
                        'REJECTED' => 'Refusé',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'PENDING')
                    ->action(function ($record) {
                        // Appel du UseCase (Clean Architecture)
                        app(ApproveStudentUseCase::class)
                            ->execute($record->user_id);

                        // 🔑 Rafraîchit le record pour Livewire/Alpine
                        $record->refresh();

                        // Optionnel : notification pour confirmer l’action à l’admin
                        Notification::make()
                            ->title('Étudiant approuvé')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentProfiles::route('/'),
        ];
    }
}
