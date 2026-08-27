<?php

use App\Filament\Resources\TeamMembers\Pages\EditTeamMember;
use App\Models\TeamMember;
use App\Models\User;
use Livewire\Livewire;

test('edit team member loads without tiptap content error', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $member = TeamMember::create([
        'full_name' => 'Berthilde W. NIKIEMA KOMBATE',
        'slug' => 'berthilde-nikiema-kombate',
        'role_title' => ['fr' => 'Secrétaire Générale', 'en' => 'General Secretary'],
        'role_category' => 'bureau_executif',
        'bio_full' => ['fr' => '<p>Juriste conseil spécialisée en droit public...</p>', 'en' => '<p>Legal advisor...</p>'],
        'is_published' => true,
    ]);

    Livewire::test(EditTeamMember::class, ['record' => $member->getKey()])
        ->assertSuccessful();
});
