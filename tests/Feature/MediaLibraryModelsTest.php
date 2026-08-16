<?php

use App\Models\BlogPost;
use App\Models\News;
use App\Models\Partner;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\Resource;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
    Storage::fake('public');
    Storage::fake('media');
});

test('all required models implement Spatie HasMedia interface', function (string $modelClass) {
    $model = new $modelClass;
    expect($model)->toBeInstanceOf(HasMedia::class);
})->with([
    'TeamMember' => [TeamMember::class],
    'Partner' => [Partner::class],
    'ResearchProject' => [ResearchProject::class],
    'Publication' => [Publication::class],
    'Resource' => [Resource::class],
    'News' => [News::class],
    'BlogPost' => [BlogPost::class],
    'SiteSetting' => [SiteSetting::class],
    'User' => [User::class],
]);

test('team member handles avatar upload and fallback url', function () {
    /** @var TeamMember $member */
    $member = TeamMember::first();

    // Fallback when no Spatie media uploaded
    expect($member->avatar_url)->toBe($member->photo);

    // Upload Spatie media
    $file = UploadedFile::fake()->image('avatar.jpg', 200, 200);
    $member->addMedia($file)->toMediaCollection('avatar');

    expect($member->fresh()->getFirstMediaUrl('avatar'))->not->toBeEmpty();
    expect($member->fresh()->avatar_url)->toBe($member->fresh()->getFirstMediaUrl('avatar'));
});

test('partner handles logo upload and fallback url', function () {
    /** @var Partner $partner */
    $partner = Partner::first();

    // Fallback when no Spatie media uploaded
    expect($partner->logo_url)->toBe($partner->logo);

    // Upload Spatie media
    $file = UploadedFile::fake()->image('partner_logo.png', 300, 100);
    $partner->addMedia($file)->toMediaCollection('logo');

    expect($partner->fresh()->getFirstMediaUrl('logo'))->not->toBeEmpty();
    expect($partner->fresh()->logo_url)->toBe($partner->fresh()->getFirstMediaUrl('logo'));
});

test('publication handles document and cover uploads', function () {
    /** @var Publication $publication */
    $publication = Publication::first();

    $pdf = UploadedFile::fake()->createWithContent('scientific_article.pdf', "%PDF-1.4\n1 0 obj\n<<>>\nendobj\ntrailer\n<<>>\n%%EOF");
    $publication->addMedia($pdf)->toMediaCollection('document');

    expect($publication->fresh()->getFirstMediaUrl('document'))->not->toBeEmpty();
    expect($publication->fresh()->document_url)->toBe($publication->fresh()->getFirstMediaUrl('document'));
});

test('news handles cover image upload and accessor', function () {
    /** @var News $news */
    $news = News::first();

    $file = UploadedFile::fake()->image('news_cover.jpg', 800, 500);
    $news->addMedia($file)->toMediaCollection('cover');

    expect($news->fresh()->getFirstMediaUrl('cover'))->not->toBeEmpty();
    expect($news->fresh()->cover_url)->toBe($news->fresh()->getFirstMediaUrl('cover'));
});

test('blog post handles cover image upload and accessor', function () {
    /** @var BlogPost $post */
    $post = BlogPost::first();

    $file = UploadedFile::fake()->image('blog_cover.jpg', 1200, 630);
    $post->addMedia($file)->toMediaCollection('cover');

    expect($post->fresh()->getFirstMediaUrl('cover'))->not->toBeEmpty();
    expect($post->fresh()->cover_url)->toBe($post->fresh()->getFirstMediaUrl('cover'));
});

test('user handles avatar upload and filament avatar url', function () {
    /** @var User $user */
    $user = User::first() ?? User::factory()->create();

    $file = UploadedFile::fake()->image('user_avatar.jpg', 150, 150);
    $user->addMedia($file)->toMediaCollection('avatar');

    expect($user->fresh()->getFilamentAvatarUrl())->not->toBeNull();
});
